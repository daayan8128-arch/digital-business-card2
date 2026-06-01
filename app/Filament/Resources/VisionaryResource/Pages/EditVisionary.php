<?php

namespace App\Filament\Resources\VisionaryResource\Pages;

use App\Filament\Resources\VisionaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisionary extends EditRecord
{
    protected static string $resource = VisionaryResource::class;
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
