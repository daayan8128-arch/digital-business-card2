<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Feedback Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('position')->required()->maxLength(255),
                Textarea::make('feedback')->required()->maxLength(1000),
                Select::make('rating')
                    ->options([
                        1 => '⭐',
                        2 => '⭐⭐',
                        3 => '⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        5 => '⭐⭐⭐⭐⭐',
                    ])
                    ->required(),
                FileUpload::make('profile_image')
                    ->disk('public_uploads')
                    ->directory('')
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->placeholder('Upload profile Image'),
                Select::make('status')
                    ->options([
                        'publics' => 'Publish',
                        'unpublics' => 'Unpublish',
                    ])
                    ->default('unpublics')
                    ->disabled(fn($record) =>
                        !Auth::user()->isSuperAdmin() &&
                        !Auth::user()->isAdmin() &&
                        $record?->user_id !== Auth::id()
                    ),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                ImageColumn::make('profile_image')
                    ->label('Profile Image')
                    ->getStateUsing(fn($record) => $record->profile_image ? asset('uploads/' . $record->profile_image) : null)
                    ->circular(),

                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('position'),
                TextColumn::make('feedback')->limit(50),
                TextColumn::make('rating')
                    ->formatStateUsing(fn($state) => str_repeat('⭐', $state))
                    ->label('Stars'),

                TextColumn::make('user.name')->label('User'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'publics' => 'success',
                        'unpublics' => 'danger',
                        default => 'secondary', // ✅ safety for unknown values
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'publics' => 'Published',
                        'unpublics' => 'Unpublished',
                        default => 'Unknown',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'publics' => 'Published',
                        'unpublics' => 'Unpublished',
                    ]),
            ])
            ->actions([
                ViewAction::make()
                    ->label('View')
                    ->modalHeading(fn($record) => 'Feedback by ' . $record->name)
                    ->form([
                        TextInput::make('name')->default(fn($record) => $record->name)->disabled(),
                        TextInput::make('position')->default(fn($record) => $record->position)->disabled(),
                        Textarea::make('feedback')->default(fn($record) => $record->feedback)->disabled(),
                        Select::make('rating')
                            ->options([1=>'⭐',2=>'⭐⭐',3=>'⭐⭐⭐',4=>'⭐⭐⭐⭐',5=>'⭐⭐⭐⭐⭐'])
                            ->default(fn($record) => $record->rating)
                            ->disabled(),
                        Select::make('status')
                            ->options(['publics'=>'Publish','unpublics'=>'Unpublish'])
                            ->default(fn($record) => $record->status)
                            ->disabled(),
                        Forms\Components\Placeholder::make('profile_image')
                            ->label('Profile Image')
                            ->content(fn($record) =>
                                $record->profile_image
                                ? '<img src="' . asset('uploads/' . $record->profile_image) . '" style="max-width:120px;border-radius:6px;">'
                                : 'No image'
                            )
                            ->columnSpanFull()
                            ->extraAttributes(['class'=>'prose'])
                            ->disableLabel(),
                    ]),

                Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->update(['status' => 'publics']))
                    ->visible(fn($record) =>
                        $record->status === 'unpublics' &&
                        (Auth::user()->isSuperAdmin() ||
                         Auth::user()->isAdmin() ||
                         $record->user_id === Auth::id())
                    ),

                Action::make('unpublish')
                    ->label('Unpublish')
                    ->icon('heroicon-o-eye-slash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->update(['status' => 'unpublics']))
                    ->visible(fn($record) =>
                        $record->status === 'publics' &&
                        (Auth::user()->isSuperAdmin() ||
                         Auth::user()->isAdmin() ||
                         $record->user_id === Auth::id())
                    ),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return $query; // superadmin sees all
        }

        

        return $query->where('user_id', $user->id); // normal users see only their feedback
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();
        $label = 'Feedback';

        if (! $user->isAdmin() && ! $user->isSuperAdmin()) {
            if (! $user->is_premium) {
                $label .= ' 👑';
            }
        }

        return $label;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
