<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurPartnerResource\Pages;
use App\Models\our_partner as OurPartner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;

class OurPartnerResource extends Resource
{
    protected static ?string $model = OurPartner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('company_logo')
                ->disk('public_uploads')
                ->directory('partners')
                ->visibility('public')
                ->image()
                ->preserveFilenames()
                ->placeholder('Upload Partner Company Logo')
                ->required(),
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

                ImageColumn::make('company_logo')
                    ->label('Company Image')
                    ->getStateUsing(fn($record) => $record->company_logo ? asset('uploads/' . $record->company_logo) : null)
                    ->circular(),
            ])
            ->recordUrl(fn($record) => OurPartnerResource::getUrl('edit', ['record' => $record]))
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

        if ( $user->isSuperAdmin()) {
            return parent::getEloquentQuery(); // ✅ Admin & SuperAdmin → all records
        }

        return parent::getEloquentQuery()
            ->where('user_id', $user->id); // ✅ Normal user → only own records
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOurPartners::route('/'),
            'create' => Pages\CreateOurPartner::route('/create'),
            'edit' => Pages\EditOurPartner::route('/{record}/edit'),
            'overview' => Pages\OurPartnerOverview::route('/overview'),
        ];
    }

    // ✅ Navigation URL override by role
    public static function getNavigationUrl(): string
    {
        $user = auth()->user();

        if ( $user->isSuperAdmin()) {
            return static::getUrl('index');   // Admin & SuperAdmin → table view
        }

        return static::getUrl('overview');    // Normal users → overview page
    }

    // ✅ Navigation label with premium crown 👑
    public static function getNavigationLabel(): string
    {
        $user = auth()->user();

        $label = 'Our Partners';

        if ($user->isUser() && ! $user->is_premium) {
            $label .= ' 👑';
        }

        return $label;
    }
}
