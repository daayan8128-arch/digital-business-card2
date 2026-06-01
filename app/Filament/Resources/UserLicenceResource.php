<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserLicenceResource\Pages;
use App\Models\UserLicence;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Auth;

class UserLicenceResource extends Resource
{
    protected static ?string $model = UserLicence::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationLabel = 'User Licences';

    // Only Super Admin can access this resource
    public static function canAccess(): bool
    {
        return Auth::check() && Auth::user()->isSuperAdmin() == 1;
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('user_id')
                ->relationship('user', 'name')
                ->label('User')
                ->searchable()
                ->required(),

            Select::make('admin_id')
                ->relationship('admin', 'name')
                ->label('Assigned By (Admin)')
                ->searchable()
                ->nullable(),

            DatePicker::make('start_date')
                ->label('Start Date')
                ->required(),

            DatePicker::make('end_date')
                ->label('End Date')
                ->required(),

            Toggle::make('is_premium')
                ->label('Is Premium')
                ->helperText('Enable if user has active premium licence')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('user.name')->label('User')->searchable()->sortable(),
                TextColumn::make('admin.name')->label('Assigned By')->sortable()->placeholder('-'),
                TextColumn::make('start_date')->label('Start Date')->date()->sortable(),
                TextColumn::make('end_date')->label('End Date')->date()->sortable(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserLicences::route('/'),
            'create' => Pages\CreateUserLicence::route('/create'),
        ];
    }
}
