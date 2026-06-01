<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Subscription;
use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Closure;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        $authUser = auth()->user();

        return $form
            ->schema([
                // ---- Subscription Info ----
                Forms\Components\Section::make('Subscription Info')
                    ->schema(function () use ($authUser) {
                        $message = 'No subscription found';

                        if ($authUser->isAdmin()) {
                            $subscription = Subscription::where('admin_id', $authUser->id)
                                ->whereDate('start_date', '<=', now())
                                ->where(function ($q) {
                                    $q->whereNull('end_date')->orWhere('end_date', '>=', now());
                                })
                                ->orderBy('end_date', 'desc')
                                ->first();

                            if ($subscription) {
                                $message = "{$subscription->remaining_premium_users} / {$subscription->total_premium_users}";
                            }
                        } elseif ($authUser->isSuperAdmin()) {
                            $message = 'Unlimited (Super Admin)';
                        }

                        return [
                            Forms\Components\Placeholder::make('Subscriptions Remaining')
                                ->content($message),
                        ];
                    })
                    ->collapsible()
                    ->visible(fn() => $authUser->isAdmin() || $authUser->isSuperAdmin()),

                // ---- Basic Info ----
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('username', Str::slug($state))),

                Forms\Components\TextInput::make('username')
                    ->required()
                    ->unique(User::class, 'username', ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'This username is already taken.',
                    ]),

                Forms\Components\TextInput::make('company_name')
                    ->label('Company Name')
                    ->nullable(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(User::class, 'email', ignoreRecord: true),

                // ---- Password (Create only) ----
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->minLength(6)
                    ->required(fn($livewire) => $livewire instanceof Pages\CreateUser)
                    ->visible(fn($livewire) => $livewire instanceof Pages\CreateUser)
                    ->dehydrated(fn($state) => filled($state)),

                Forms\Components\Select::make('access')
                    ->label('Access')
                    ->options([
                        'unblock' => 'Unblock',
                        'block' => 'Block',
                    ])
                    ->default('unblock')
                    ->visible(fn() => $authUser->isSuperAdmin())
                    ->required(),

                // ---- Role (Super Admin only) ----
                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options([
                        User::ROLE_USER => 'User',
                        User::ROLE_ADMIN => 'Admin',
                         
                    ])
                    ->default(User::ROLE_USER)
                    ->visible(fn() => $authUser->isSuperAdmin()),

                // ---- Change Password (Self only) ----
                Forms\Components\Section::make('Change Password')
                    ->schema([
                        Forms\Components\TextInput::make('current_password')
                            ->label('Current Password')
                            ->password()
                            ->revealable()
                            ->required(fn($record, $get) => $record && $record->id === $authUser->id && !empty($get('new_password')))
                            ->visible(fn($record) => $record && $record->id === $authUser->id)
                            ->dehydrated(false)
                            ->rule(function ($record) {
                                return function (string $attribute, $value, Closure $fail) use ($record) {
                                    if (!empty($value) && !Hash::check($value, $record->password)) {
                                        $fail('The current password is incorrect.');
                                    }
                                };
                            }),

                        Forms\Components\TextInput::make('new_password')
                            ->label('New Password')
                            ->password()
                            ->minLength(6)
                            ->revealable()
                            ->required(fn($record, $get) => $record && $record->id === $authUser->id && !empty($get('current_password')))
                            ->visible(fn($record) => $record && $record->id === $authUser->id)
                            ->dehydrated(false)
                            ->confirmed(),

                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->label('Confirm New Password')
                            ->password()
                            ->minLength(6)
                            ->revealable()
                            ->required(fn($record, $get) => $record && $record->id === $authUser->id && !empty($get('new_password')))
                            ->visible(fn($record) => $record && $record->id === $authUser->id)
                            ->dehydrated(false),
                    ])
                    ->collapsible()
                    ->visible(fn($record) => $record && $record->id === $authUser->id),

                // ---- Premium Fields ----
                Forms\Components\Toggle::make('is_premium')
                    ->label('Premium User')
                    ->default(false)
                    ->reactive()
                    ->visible(fn() => $authUser->isAdmin() || $authUser->isSuperAdmin())
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('premium_start_date', now()->format('Y-m-d'));
                            $set('premium_end_date', now()->addYear()->format('Y-m-d'));
                        } else {
                            $set('premium_start_date', null);
                            $set('premium_end_date', null);
                        }
                    }),

                Forms\Components\DatePicker::make('premium_start_date')
                    ->label('Premium Start Date')
                    ->visible(fn($get) => $get('is_premium') && ($authUser->isAdmin() || $authUser->isSuperAdmin()))
                    ->disabled(fn() => !$authUser->isSuperAdmin()),

                Forms\Components\DatePicker::make('premium_end_date')
                    ->label('Premium End Date')
                    ->visible(fn($get) => $get('is_premium') && ($authUser->isAdmin() || $authUser->isSuperAdmin()))
                    ->disabled(fn() => !$authUser->isSuperAdmin()),

                Forms\Components\Hidden::make('premium_given_by')
                    ->default(auth()->id()),
            ]);
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        $authUser = auth()->user();
        $recordId = request()->route('record');
        $record = $recordId ? User::find($recordId) : null;

        unset($data['current_password'], $data['new_password'], $data['new_password_confirmation']);

        // Role logic
        if ($authUser->isSuperAdmin() && isset($data['role'])) {
            // Keep the provided role if user is super admin
            // No change needed, value already set
        } else {
            $data['role'] = $record?->role ?? User::ROLE_USER;
        }

        // Access field
        $data['access'] = $authUser->isSuperAdmin() ? ($data['access'] ?? 'unblock') : ($record?->access ?? 'unblock');

        // Premium logic (same as before)
        if (isset($data['is_premium']) && $data['is_premium']) {
            if (!$record || !$record->is_premium) {
                if ($authUser->isSuperAdmin()) {
                    $data['premium_start_date'] = $data['premium_start_date'] ?? now();
                    $data['premium_end_date'] = $data['premium_end_date'] ?? now()->addYear();
                    $data['premium_given_by'] = $authUser->id;
                } elseif ($authUser->isAdmin()) {
                    $subscription = Subscription::where('admin_id', $authUser->id)
                        ->whereDate('start_date', '<=', now())
                        ->where(function ($q) {
                            $q->whereNull('end_date')->orWhere('end_date', '>=', now());
                        })
                        ->where('remaining_premium_users', '>', 0)
                        ->orderBy('end_date', 'desc')
                        ->lockForUpdate()
                        ->first();

                    if ($subscription) {
                        $subscription->decrement('remaining_premium_users');
                        $data['premium_start_date'] = now();
                        $data['premium_end_date'] = now()->addYear();
                        $data['premium_given_by'] = $authUser->id;
                    } else {
                        abort(403, 'You have no active premium subscriptions remaining.');
                    }
                }
            } else {
                $data['premium_start_date'] = $data['premium_start_date'] ?? $record->premium_start_date;
                $data['premium_end_date'] = $data['premium_end_date'] ?? $record->premium_end_date;
                $data['premium_given_by'] = $record->premium_given_by;
            }
        } else {
            if ($record && $record->is_premium) {
                $data['premium_start_date'] = null;
                $data['premium_end_date'] = null;
                $data['premium_given_by'] = null;

                if ($authUser->isAdmin() && $record->premium_given_by === $authUser->id) {
                    $subscription = Subscription::where('admin_id', $authUser->id)
                        ->whereDate('start_date', '<=', now())
                        ->where(function ($q) {
                            $q->whereNull('end_date')->orWhere('end_date', '>=', now());
                        })
                        ->orderBy('end_date', 'desc')
                        ->lockForUpdate()
                        ->first();

                    if ($subscription) {
                        $subscription->increment('remaining_premium_users');
                    }
                }
            }
        }

        return $data;
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $authUser = auth()->user();
        $data['created_by'] = $authUser->id ?? null;

        // Password hashing
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Role logic
        $data['role'] = ($authUser->isSuperAdmin() && !empty($data['role']))
            ? $data['role']
            : User::ROLE_USER;

        // Access field
        $data['access'] = $authUser->isSuperAdmin() ? ($data['access'] ?? 'unblock') : 'unblock';

        // Premium logic (same as before)
        if (isset($data['is_premium']) && $data['is_premium']) {
            if ($authUser->isSuperAdmin()) {
                $data['premium_start_date'] = $data['premium_start_date'] ?? now();
                $data['premium_end_date'] = $data['premium_end_date'] ?? now()->addYear();
                $data['premium_given_by'] = $authUser->id;
            } elseif ($authUser->isAdmin()) {
                $subscription = Subscription::where('admin_id', $authUser->id)
                    ->whereDate('start_date', '<=', now())
                    ->where(function ($q) {
                        $q->whereNull('end_date')->orWhere('end_date', '>=', now());
                    })
                    ->where('remaining_premium_users', '>', 0)
                    ->orderBy('end_date', 'desc')
                    ->lockForUpdate()
                    ->first();

                if ($subscription) {
                    $subscription->decrement('remaining_premium_users');
                    $data['premium_start_date'] = now();
                    $data['premium_end_date'] = now()->addYear();
                    $data['premium_given_by'] = $authUser->id;
                } else {
                    abort(403, 'You have no active premium subscriptions remaining.');
                }
            }
        }

        return $data;
    }

    public static function afterSave(Model $record, array $data): void
    {
        $authUser = auth()->user();

        if ($record && $record->id === $authUser->id && !empty($data['new_password'])) {
            $record->password = Hash::make($data['new_password']);
            $record->save();
        }
    }

    public static function table(Table $table): Table
    {
        $authUser = auth()->user();

        return $table
            ->columns([
                TextColumn::make('creator.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable()
                    ->visible(fn() => $authUser->isSuperAdmin()),

                TextColumn::make('id')->label('User ID'),
                TextColumn::make('username')->label('Username')->searchable()->sortable(),
                TextColumn::make('company_name')->label('Company')->sortable()->searchable(),

                TextColumn::make('creator.id')
                    ->label('Admin ID')
                    ->placeholder('-')
                    ->visible(fn() => $authUser->isSuperAdmin()),

                TextColumn::make('premiumGiver.name')
                    ->label('Premium Assigned By')
                    ->placeholder('-')
                    ->visible(fn() => $authUser->isSuperAdmin()),

                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),

                Tables\Columns\BooleanColumn::make('is_premium')
                    ->label('Premium'),

                TextColumn::make('premium_start_date')
                    ->label('Premium Start')
                    ->date('d M Y')
                    ->placeholder('-'),

                TextColumn::make('premium_end_date')
                    ->label('Premium End')
                    ->date('d M Y')
                    ->placeholder('-'),

                TextColumn::make('role')
                    ->label('Role')
                    ->sortable()
                    ->searchable()
                    ->visible(fn() => $authUser->isSuperAdmin()),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function ($record) use ($authUser) {
                        if ($authUser->isSuperAdmin())
                            return true;
                        if ($authUser->isAdmin()) {
                            return $record->id === $authUser->id ||
                                $record->created_by === $authUser->id ||
                                $record->premium_given_by === $authUser->id ||
                                !$record->is_premium;
                        }
                        return $record->id === $authUser->id;
                    }),

                Tables\Actions\DeleteAction::make()
                    ->visible(function ($record) use ($authUser) {
                        if ($authUser->isSuperAdmin())
                            return true;
                        if ($authUser->isAdmin()) {
                            return $record->created_by === $authUser->id;
                        }
                        return false;
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn() => $authUser->isSuperAdmin()),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            return parent::getEloquentQuery();
        }

        if ($user->isAdmin()) {
            return parent::getEloquentQuery()
                ->where('role', '!=', User::ROLE_SUPERADMIN)
                ->where(function ($query) use ($user) {
                    $query->where('id', $user->id)
                        ->orWhere('created_by', $user->id)
                        ->orWhere('premium_given_by', $user->id)
                        ->orWhere(function ($q) {
                            $q->where('is_premium', false)
                                ->whereNull('premium_given_by');
                        });
                });
        }

        return parent::getEloquentQuery()
            ->where('id', $user->id);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
