<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessDetailsResource\Pages;
use App\Models\BusinessDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
 
class BusinessDetailsResource extends Resource
{
    protected static ?string $model = BusinessDetail::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Personal Information Section
            Forms\Components\Section::make('Personal Information')
                ->schema([
                    Forms\Components\FileUpload::make('photo_path')
                        ->disk('public_uploads')
                        ->directory('')
                        ->image()
                        ->visibility('public')
                        ->preserveFilenames()
                        ->getUploadedFileNameForStorageUsing(fn($file) => $file->getClientOriginalName()),

                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->default(fn() => auth()->user()->name)
                        ->placeholder('Enter Your Name'),

                    Forms\Components\TextInput::make('designation')
                        ->maxLength(255)
                        ->placeholder('Enter Your Designation, e.g., Manager...'),
                ])
                ->columns(2),

            // Contact Information Section
            Forms\Components\Section::make('Contact Information')
                ->schema([
                    Forms\Components\TextInput::make('phone')
                        ->required()
                        ->maxLength(20)
                        ->default(null)
                        ->placeholder('Enter Your Phone Number'),

                    Forms\Components\TextInput::make('secondary_phone')
                        ->maxLength(20)
                        ->placeholder('Enter Your Secondary Phone Number'),

                    Forms\Components\TextInput::make('whatsapp')
                        ->maxLength(20)
                        ->placeholder('Enter Your WhatsApp Number'),

                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->email()
                        ->maxLength(255)
                        ->default(fn() => auth()->user()->email)
                        ->placeholder('Enter Your Email'),

                    Forms\Components\TextInput::make('secondary_email')
                        ->maxLength(255)
                        ->email()
                        ->placeholder('Enter Your Secondary Email'),
                ])
                ->columns(2),

            // Business Information Section
            Forms\Components\Section::make('Business Information')
                ->schema([
                    Forms\Components\TextInput::make('business_name')
                        ->required()
                        ->maxLength(255)
                        ->default(fn() => auth()->user()->company_name)
                        ->placeholder('Enter your Company Name'),

                    Forms\Components\TextInput::make('tagline')
                        ->maxLength(255)
                        ->placeholder('Enter your Company Tagline e.g. Creative Design & Printing Solutions'),

                    Forms\Components\FileUpload::make('company_logo')
                        ->disk('public_uploads')
                        ->directory('')
                        ->visibility('public')
                        ->image()
                        ->preserveFilenames()
                        ->placeholder('Upload Company Logo'),

                    Forms\Components\TextInput::make('gstin')
                        ->maxLength(255)
                        ->placeholder('Enter Your GSTIN'),
                ])
                ->columns(2),

            // Business Hours & Address Section
            Forms\Components\Section::make('Business Hours & Address')
                ->schema([
                    Forms\Components\Textarea::make('business_hours')
                        ->placeholder('This detail shows in contact us page')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('address')
                        ->placeholder('Enter Your Company Address')
                        ->columnSpanFull(),
                ]),

            // Social Media & Website Links Section
            Forms\Components\Section::make('Social Media & Website Links')
                ->schema([
                    Forms\Components\TextInput::make('website')
                        ->maxLength(255)
                        ->nullable()
                        ->placeholder('Enter Your Website URL'),

                    Forms\Components\TextInput::make('facebook')
                        ->url()
                        ->maxLength(255)
                        ->placeholder('Enter Your Facebook URL'),

                    Forms\Components\TextInput::make('instagram')
                        ->url()
                        ->maxLength(255)
                        ->placeholder('Enter Your Instagram URL'),

                    Forms\Components\TextInput::make('linkedin')
                        ->url()
                        ->maxLength(255)
                        ->placeholder('Enter Your LinkedIn URL'),

                    Forms\Components\TextInput::make('twitter')
                        ->url()
                        ->maxLength(255)
                        ->placeholder('Enter Your Twitter URL'),

                    Forms\Components\TextInput::make('youtube')
                        ->url()
                        ->maxLength(255)
                        ->placeholder('Enter Your YouTube URL'),
                ])
                ->columns(2),
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

                ImageColumn::make('photo_path')
                    ->label('Photo')
                    ->getStateUsing(fn($record) => $record->photo_path_url)
                    ->circular(),

                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('phone')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
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
    $query = parent::getEloquentQuery();
    $user = auth()->user();

    if ($user && $user->isSuperAdmin()) {
        return $query; // SuperAdmin sees all records
    }

    if ($user) {
        return $query->where('user_id', $user->id);
    }

    return $query;
}



    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinessDetails::route('/'),
            'create' => Pages\CreateBusinessDetails::route('/create'),
            'edit' => Pages\EditBusinessDetails::route('/{record}/edit'),
        ];
    }
}
