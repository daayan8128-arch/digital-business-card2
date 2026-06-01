<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankDetailResource\Pages;
use App\Models\bank_detail as BankDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Navigation\NavigationItem;

class BankDetailResource extends Resource
{
    protected static ?string $model = BankDetail::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('google_pay_number')->numeric()->nullable()->placeholder('Enter Google Pay Number'),
            Forms\Components\TextInput::make('phonepe_number')->numeric()->nullable()->placeholder('Enter PhonePe Number'),
            Forms\Components\TextInput::make('upi_id')->nullable()->placeholder('Enter UPI ID'),
            Forms\Components\TextInput::make('paytm_number')->numeric()->nullable()->placeholder('Enter Paytm Number'),
            Forms\Components\TextInput::make('account_name')->nullable()->placeholder('Enter Account Name'),
            Forms\Components\TextInput::make('bank_name')->nullable()->placeholder('Enter Bank Name'),
            Forms\Components\TextInput::make('branch_name')->nullable()->placeholder('Enter Branch Name'),
            Forms\Components\TextInput::make('ifsc_code')->nullable()->placeholder('Enter IFSC Code'),
            FileUpload::make('scanner_image')
                ->disk('public_uploads')
                ->directory('')
                ->visibility('public')
                ->image()
                ->placeholder('Upload Scanner Image'),
        ])->statePath('data');
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('user.name')->label('Created By')->sortable()->searchable(),
            TextColumn::make('google_pay_number')->label('Google Pay Number'),
            TextColumn::make('phonepe_number')->label('PhonePe Number'),
            TextColumn::make('upi_id')->label('UPI ID'),
            TextColumn::make('paytm_number')->label('Paytm Number'),
            TextColumn::make('account_name')->label('Account Name'),
            TextColumn::make('bank_name')->label('Bank Name'),
            TextColumn::make('branch_name')->label('Branch Name'),
            TextColumn::make('ifsc_code')->label('IFSC Code'),
            ImageColumn::make('scanner_image')
                ->label('Scanner Image')
                ->getStateUsing(fn($record) => $record->scanner_image_url)
                ->circular(),
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

        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankDetails::route('/'),
            'create' => Pages\CreateBankDetail::route('/create'),
            'edit' => Pages\EditBankDetail::route('/{record}/edit'),
            'overview' => Pages\BankDetailsOverview::route('/overview'),
        ];
    }

    public static function getCreateFormActions(): array
    {
        return [
            \Filament\Forms\Components\Actions\Action::make('save')
                ->label('Save')
                ->submit('create'),
        ];
    }

    public static function getNavigationItems(): array
    {
        $user = auth()->user();
        $isAdminOrSuper = $user && ( $user->isSuperAdmin());

        $label = 'Bank Details';

        // ✅ Only for normal users with no premium
        if ($user && $user->isUser() && ($user->is_premium ?? 0) == 0) {
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

    public static function getNavigationLabel(): string
    {
        $user = auth()->user();
        $label = 'Bank Details';

        if ($user && $user->isUser() && ($user->is_premium ?? 0) == 0) {
            $label .= ' 👑';
        }

        return $label;
    }

    public static function getNavigationUrl(): string
    {
        $user = auth()->user();

        if ($user->isAdmin() || $user->isSuperAdmin()) {
            return static::getUrl('index');   // Admins go to index view
        }

        return static::getUrl('overview');    // Normal users go to overview page
    }
}
