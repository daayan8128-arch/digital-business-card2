<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\portfolio as Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('portfolio_image')
                    ->disk('public_uploads')
                    ->directory('')
                    ->visibility('public')
                    ->image()
                    ->required()
                    ->preserveFilenames()
                    ->placeholder('Upload portfolio Image'),

                Forms\Components\TextInput::make('category')->required()->maxLength(255),
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\Textarea::make('about_project')->required()->placeholder('Give me a short Version of about this project')->maxLength(255),
                Forms\Components\Textarea::make('description')->required()->placeholder('Describe the project in detail'),
                Forms\Components\TextInput::make('client_name')->maxLength(255),
                Forms\Components\DatePicker::make('date_completed'),
                Forms\Components\TextInput::make('service_type')->maxLength(255)->placeholder('Web Design, Frontend Development, UX Strategy'),
                Forms\Components\TextInput::make('technologies_used')->maxLength(255)->placeholder('React, Node.js, MongoDB, Stripe API, AWS'),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable(),

                \Filament\Tables\Columns\ImageColumn::make('portfolio_image')
                    ->label('Portfolio Image')
                    ->getStateUsing(fn($record) => $record->portfolio_image_url)
                    ->circular(),

                Tables\Columns\TextColumn::make('category')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('client_name')->sortable(),
                Tables\Columns\TextColumn::make('date_completed')->date()->sortable(),
            ])
            ->recordUrl(fn($record) => PortfolioResource::getUrl('edit', ['record' => $record]))
            ->filters([
                //
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Admin and SuperAdmin see all records
        if ( $user->isSuperAdmin()) {
            return parent::getEloquentQuery();
        }

        // Normal users see only their own records
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();

        $label = 'Portfolios';

        // Show crown 👑 for normal users who are not premium
        if (!$user->isAdmin() && !$user->isSuperAdmin()) {
            if (!$user->is_premium) {
                $label .= ' 👑';
            }
        }

        return $label;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
