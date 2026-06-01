<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Filament\Resources\MediaResource\RelationManagers;
use App\Models\media as Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\Url;
use Filament\Forms\Components\UploadedFile as UploadedFileComponent;
use FIlament\Forms\Components\make;
use App\Filament\Resources\MediaResource\Pages\ViewMedia;
use Filament\Tables\Actions\Action;


class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // File Upload Section
                Section::make('Media File Upload')
                    ->description('Upload your media file here')
                    ->icon('heroicon-o-cloud-arrow-up') // Fixed icon name
                    ->schema([
                        Forms\Components\FileUpload::make('media_file')
                            ->disk('media_public')
                            ->directory('/')
                            ->nullable()
                            ->placeholder('Select a file to upload pdf file')
                            ->maxSize(1024000)
                            ->acceptedFileTypes(['application/pdf', 'image/*', 'video/*'])
                            ->helperText('Allowed types: PDF, Images, Videos')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible(),

                // PDF Information Section
                Section::make('PDF Information')
                    ->description('Enter details about your PDF')
                    ->icon('heroicon-o-document-text') // Fixed icon name
                    ->schema([
                        Forms\Components\TextInput::make('pdf_title')
                            ->nullable()
                            ->placeholder('Enter PDF title')
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('pdf_name')
                            ->nullable()
                            ->placeholder('Enter PDF name')
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\Textarea::make('pdf_description')
                            ->nullable()
                            ->placeholder('Enter PDF description')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Video Information Section
                Section::make('Video Information')
                    ->description('Enter details about your video')
                    ->icon('heroicon-o-play') // Fixed icon name
                    ->schema([
                        Forms\Components\TextInput::make('video_url')
                            ->label('YouTube Video URL')
                            ->url()
                            ->nullable()
                            ->placeholder('https://youtube.com/...')
                            ->prefixIcon('heroicon-o-link')
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('video_name')
                            ->nullable()
                            ->placeholder('Enter video name')
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\Textarea::make('video_description')
                            ->nullable()
                            ->placeholder('Enter video description')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Information section (only visible when editing)
                Section::make('Additional Information')
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn($record) => $record?->created_at?->toFormattedDateString() ?? '-'),

                        Placeholder::make('updated_at')
                            ->label('Updated at')
                            ->content(fn($record) => $record?->updated_at?->toFormattedDateString() ?? '-'),
                    ])
                    ->columns(2)
                    ->visibleOn('edit')
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

                Tables\Columns\TextColumn::make('pdf_title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pdf_name'),
                Tables\Columns\TextColumn::make('pdf_description')->limit(50),
                Tables\Columns\TextColumn::make('video_url')->url(fn($record) => $record->video_url)->openUrlInNewTab()
                    ->copyable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('video_name'),
                Tables\Columns\TextColumn::make('video_description')->limit(50),
            ])
            ->recordUrl(fn($record) => MediaResource::getUrl('edit', ['record' => $record]))

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
        $user = auth()->user();

        // Admin & SuperAdmin see all records
        if ( $user->isSuperAdmin()) {
            return parent::getEloquentQuery();
        }

        // Normal users see only their own records
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }


    public static function getNavigationLabel(): string
    {
        $user = auth()->user();
        $label = 'Media';

        // Only for normal non-premium users
        if (!$user->isAdmin() && !$user->isSuperAdmin() && ($user->is_premium ?? 0) == 0) {
            $label .= ' 👑';
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
            'view' => ViewMedia::route('/{record}'), // ✅ Add this line
        ];
    }
}