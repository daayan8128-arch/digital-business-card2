<?php

namespace App\Filament\Resources\OurClientResource\Pages;

use App\Filament\Resources\OurClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOurClient extends EditRecord
{
    protected static string $resource = OurClientResource::class;
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
