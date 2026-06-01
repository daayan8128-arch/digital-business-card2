<?php

namespace App\Filament\Resources\BusinessDetailsResource\Pages;

use App\Filament\Resources\BusinessDetailsResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;

class CreateBusinessDetails extends CreateRecord
{
    protected static string $resource = BusinessDetailsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Create button ka label change karega ("Save" instead of "Create")
     */
    protected function getCreateFormActionLabel(): string
    {
        return 'Save';
    }

    /**
     * "Create & create another" option ko hatata hai
     */
    protected function hasCreateAnother(): bool
    {
        return false;
    }

    /**
     * Sirf "Save" aur "Cancel" buttons dikhane ke liye
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
