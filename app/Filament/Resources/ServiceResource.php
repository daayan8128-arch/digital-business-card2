<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\service as Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('service_image')
                ->disk('public_uploads')
                ->directory('')
                ->visibility('public')
                ->image()
                ->preserveFilenames()
                ->placeholder('Upload Service Image'),

            Forms\Components\TextInput::make('service_name')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('service_description')
                ->required()
                ->placeholder('Describe the service in detail'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('service_image')
                    ->label('Service Image')
                    ->getStateUsing(fn($record) => $record->service_image ? asset('uploads/' . $record->service_image) : null)
                    ->circular(),

                Tables\Columns\TextColumn::make('service_name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('service_description')->limit(50),
            ])
            ->recordUrl(fn($record) => static::getUrl('edit', ['record' => $record]))
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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

        if ($user->isSuperAdmin()) {
            return parent::getEloquentQuery();
        }

         

        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();
        $label = 'Services';

        if (!$user->isAdmin() && !$user->isSuperAdmin()) {
            if (!$user->is_premium) {
                $label .= ' 👑';
            }
        }

        return $label;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
            'overview' => Pages\ServiceOverview::route('/overview'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        $user = auth()->user();

        if (  $user->isSuperAdmin()) {
            return static::getUrl('index');
        }

        return static::getUrl('overview');
    }
}
