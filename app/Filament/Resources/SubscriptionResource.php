<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Subscription;
use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Admin Management';
    protected static ?string $navigationLabel = 'Subscriptions';

    public static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();
        return $user && ($user->isAdmin() || $user->isSuperAdmin());
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && ($user->isAdmin() || $user->isSuperAdmin());
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        $user = Auth::user();

        return $form->schema([
            TextInput::make('total_premium_users')
                ->numeric()
                ->required()
                ->minValue(1),

            Forms\Components\Hidden::make('start_date')->default(now())->dehydrated(),

            Select::make('admin_id')
                ->label('Assign To (Admin)')
                ->options(User::where('role', User::ROLE_ADMIN)->pluck('name', 'id')->toArray())
                ->required()
                ->searchable()
                ->preload(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        $user = Auth::user();

        return $table
            ->columns([
                TextColumn::make('creator.name')->label('Created By'),
                TextColumn::make('assignedTo.name')->label('Assigned To (Admin)'),
                TextColumn::make('total_premium_users')->label('Total Premium'),
                TextColumn::make('remaining_premium_users')->label('Remaining Premium'),
            ])
            ->defaultSort('start_date', 'desc')
            ->actions($user->isSuperAdmin() ? [EditAction::make(), DeleteAction::make()] : [])
            ->bulkActions($user->isSuperAdmin() ? [Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ])] : []);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        $data['created_by'] = $user->id;
        $data['remaining_premium_users'] = $data['total_premium_users'];

        if (!$user->isSuperAdmin()) {
            $data['start_date'] = now();
            $data['end_date'] = now()->addYear();
        }

        // Admin creating subscription assigns themselves if not already set
        if ($user->isAdmin() && empty($data['admin_id'])) {
            $data['admin_id'] = $user->id;
        }

        return $data;
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return parent::getEloquentQuery();
        }

        if ($user->isAdmin()) {
            return parent::getEloquentQuery()->where('admin_id', $user->id);
        }

        return parent::getEloquentQuery()->whereRaw('1 = 0'); // normal users see nothing
    }

    public static function afterSave(Subscription $subscription): void
    {
        $adminId = $subscription->admin_id;

        $usedLicenses = User::where('premium_given_by', $adminId)
            ->whereNotNull('premium_start_date')
            ->whereNotNull('premium_end_date')
            ->count();

        $subscription->remaining_premium_users = max(0, $subscription->total_premium_users - $usedLicenses);
        $subscription->save();
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->isSuperAdmin() ?? false;
    }

    public static function canEdit($record): bool
    {
        return Auth::user()?->isSuperAdmin() ?? false;
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->isSuperAdmin() ?? false;
    }
}
