<?php

namespace App\Filament\Resources\OurPartnerResource\Pages;

use App\Filament\Resources\OurPartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOurPartner extends EditRecord
{
    protected static string $resource = OurPartnerResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
