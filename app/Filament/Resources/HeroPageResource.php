<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroPageResource\Pages;
use App\Models\heropage as HeroPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Navigation\NavigationItem;

class HeroPageResource extends Resource
{
    protected static ?string $model = HeroPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('heroimage')
                    ->disk('public')
                    ->directory('hero')
                    ->image()
                    ->visibility('public')
                    ->required(),

                Forms\Components\TextInput::make('title')->nullable(),
                Forms\Components\TextInput::make('subtitle'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('user.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable(),

                \Filament\Tables\Columns\ImageColumn::make('heroimage')
                    ->label('Hero Image')
                    ->getStateUsing(fn($record) => $record->heroimage ? asset('uploads/' . $record->heroimage) : null)
                    ->circular(),

                \Filament\Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                \Filament\Tables\Columns\TextColumn::make('subtitle'),
            ])
            ->recordUrl(fn($record): string => route('filament.admin.resources.hero-pages.edit', ['record' => $record]));
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ($user && ($user->isSuperAdmin())) {
            return parent::getEloquentQuery(); // Admin & SuperAdmin see all
        }
        
        // Normal users: only their own records
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        $user = auth()->user();
        $isAdminOrSuper = $user && ($user->isSuperAdmin());

        return [
            'index' => Pages\ListHeroPages::route('/'), // always define index route
            'create' => Pages\CreateHeroPage::route('/create'),
            'edit' => Pages\EditHeroPage::route('/{record}/edit'),
            'overview' => Pages\HeroPageOverview::route('/overview'), // normal users main page
        ];
    }

    public static function getNavigationItems(): array
    {
        $user = auth()->user();
        $isAdminOrSuper = $user && ( $user->isSuperAdmin());

        $label = 'Hero Pages';
        if ($user && !$user->isAdmin() && !$user->isSuperAdmin() && ($user->is_premium ?? 0) == 0) {
            $label .= ' 👑';
        }

        if ($isAdminOrSuper) {
            return [
                NavigationItem::make()
                    ->label($label)
                    ->url(static::getUrl('index'))
                    ->icon(static::getNavigationIcon())
                    ->isActiveWhen(fn (): bool => request()->routeIs(static::getRouteBaseName() . '.index')),
            ];
        }

        return [
            NavigationItem::make()
                ->label($label)
                ->url(static::getUrl('overview'))
                ->icon(static::getNavigationIcon())
                ->isActiveWhen(fn (): bool => request()->routeIs(static::getRouteBaseName() . '.overview')),
        ];
    }
}
