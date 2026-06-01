<?php

namespace App\Filament\Resources\OurPartnerResource\Pages;

 use App\Filament\Resources\OurPartnerResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;

class CreateOurPartner extends CreateRecord
{
    protected static string $resource = OurPartnerResource::class;

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
