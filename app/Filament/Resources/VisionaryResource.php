<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisionaryResource\Pages;
use App\Models\article as Visionary;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class VisionaryResource extends Resource
{
    protected static ?string $model = Visionary::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('article_image')
                ->disk('public_uploads')
                ->directory('')
                ->visibility('public')
                ->image()
                ->preserveFilenames()
                ->placeholder('Upload Article Image'),

            TextInput::make('article_title')->nullable()->maxLength(255),
            Textarea::make('article_description')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->label('Created By')
                ->sortable()
                ->searchable(),

            Tables\Columns\ImageColumn::make('article_image')
                ->label('Article Image')
                ->getStateUsing(fn($record) =>
                    $record->article_image ? asset('uploads/' . $record->article_image) : null
                )
                ->circular(),

            Tables\Columns\TextColumn::make('article_title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('article_description')->limit(50),
        ])
        ->recordUrl(fn($record) => VisionaryResource::getUrl('edit', ['record' => $record]))
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ( $user->isSuperAdmin()) {
            return parent::getEloquentQuery(); // SuperAdmins see all
        }

        return parent::getEloquentQuery()->where('user_id', $user->id); // Normal users see their own
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();
        $label = 'Visionary';

        if (!$user->isAdmin() && !$user->isSuperAdmin()) {
            if ($user->is_premium == 0) {
                $label .= ' 👑';
            }
        }

        return $label;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisionaries::route('/'),
            'create' => Pages\CreateVisionary::route('/create'),
            'edit' => Pages\EditVisionary::route('/{record}/edit'),
            'overview' => Pages\VisionaryOverview::route('/overview'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            return static::getUrl('index'); // SuperAdmin → table
        }

        return static::getUrl('overview'); // Normal users → overview page
    }
}
