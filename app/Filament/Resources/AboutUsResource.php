<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Filament\Resources\AboutUsResource\RelationManagers;
use App\Models\about_us as AboutUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('About Content')
                    ->schema([
                        Forms\Components\Textarea::make('about_content')
                            ->label('About Content*')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('about_content2')
                            ->label('About Content 2')
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Vision')
                    ->schema([
                        Forms\Components\TextInput::make('vision_title')
                            ->label('Vision Title')
                            ->placeholder('A company that brings your vision to life'),
                        Forms\Components\Textarea::make('vision_content')
                            ->label('Vision Content')
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Company Information')
                    ->schema([
                        Forms\Components\Textarea::make('company_goal')
                            ->label('Company Goal')
                            ->columnSpanFull(),
                    ]),
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

                Tables\Columns\TextColumn::make('about_content')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('vision_title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
            ])
            ->recordUrl(fn($record) => static::getUrl('edit', ['record' => $record]))
            ->filters([
                //
            ])
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
        $query = parent::getEloquentQuery();
        
        // ✅ New role-based check
        if (auth()->user()->isSuperAdmin()) {
            return $query; // superadmin see all
        }

        return $query->where('user_id', auth()->id()); // normal users see only their data
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();

        // Default label
        $label = 'About Us';

        // ✅ Only for normal users (not admin / not superadmin)
        if ($user->isUser()) {
            if ($user->is_premium == 0) {
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
            'index' => Pages\ListAboutUs::route('/'),
            'create' => Pages\CreateAboutUs::route('/create'),
            'edit' => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }
}
