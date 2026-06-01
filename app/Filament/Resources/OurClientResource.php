<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurClientResource\Pages;
use App\Models\our_client as OurClient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class OurClientResource extends Resource
{
    protected static ?string $model = OurClient::class;
    protected static ?string $navigationLabel = 'Our Clients';
    protected static ?string $pluralModelLabel = 'Our Clients';
    protected static ?string $modelLabel = 'Our Client';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('client_company_logo')
                ->disk('public_uploads')   // 👈 custom disk (public/uploads)
                ->directory('clients')     // uploads/clients/
                ->visibility('public')
                ->image()
                ->preserveFilenames()
                ->placeholder('Upload Client Company Logo')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('client_company_logo')
                    ->label('Client Image')
                    ->getStateUsing(fn($record) => $record->client_company_logo ? asset('uploads/' . $record->client_company_logo) : null)
                    ->circular(),
            ])
            ->recordUrl(fn($record) => OurClientResource::getUrl('edit', ['record' => $record]))
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

        if ($user->isAdmin() || $user->isSuperAdmin()) {
            return parent::getEloquentQuery(); // Admin / SuperAdmin → all records
        }

        // Normal users → only their own records
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOurClients::route('/'),
            'create' => Pages\CreateOurClient::route('/create'),
            'edit' => Pages\EditOurClient::route('/{record}/edit'),
            // Custom overview page for normal users
            'overview' => Pages\OurClientOverview::route('/overview'),
        ];
    }

    // Navigation URL based on role
    public static function getNavigationUrl(): string
    {
        $user = auth()->user();

        if ( $user->isSuperAdmin()) {
            return static::getUrl('index'); // admin / superadmin → list page
        }

        return static::getUrl('overview'); // normal users → overview page
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();

        $label = 'Our Clients';

        if (! $user->isAdmin() && ! $user->isSuperAdmin()) {
            if (($user->is_premium ?? 0) == 0) {
                $label .= ' 👑';
            }
        }

        return $label;
    }
}
