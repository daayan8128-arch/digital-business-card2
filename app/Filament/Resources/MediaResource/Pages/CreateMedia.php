<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;

class CreateMedia extends CreateRecord
{
    protected static string $resource = MediaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id(); // ✅ logged-in user's ID save karega
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Create button ka label change karega ("Save")
     */
    protected function getCreateFormActionLabel(): string
    {
        return 'Save';
    }

    /**
     * "Create & create another" ko disable karega
     */
    protected function hasCreateAnother(): bool
    {
        return false;
    }

    /**
     * Sirf Save aur Cancel buttons show karega
     */
    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Save')
                ->submit('create'),

            Actions\Action::make('cancel')
                ->label('Cancel')
                ->url($this->getResource()::getUrl('index')),
        ];
    }
}
