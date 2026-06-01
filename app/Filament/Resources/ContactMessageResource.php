<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter Name'),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter Email'),

                Forms\Components\TextInput::make('phone')
                    ->nullable()
                    ->maxLength(20)
                    ->placeholder('Enter Phone Number'),

                Forms\Components\TextInput::make('subject')
                    ->nullable()
                    ->maxLength(255)
                    ->placeholder('Enter Subject'),

                Forms\Components\Textarea::make('message')
                    ->required()
                    ->placeholder('Enter Message')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('phone')->label('Phone'),
                TextColumn::make('subject')->label('Subject'),
                TextColumn::make('message')->label('Message')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // ✅ Updated role logic
        if ($user->isSuperAdmin()) {
            return parent::getEloquentQuery(); // admin & superadmin see all
        }

        return parent::getEloquentQuery()
            ->where('user_id', $user->id); // normal users see only their messages
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();

        $label = 'Contact Messages';

        // Sirf normal users ke liye (not admin / not superadmin)
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
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
