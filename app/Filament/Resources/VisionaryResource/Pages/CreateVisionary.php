<?php

namespace App\Filament\Resources\VisionaryResource\Pages;

use App\Filament\Resources\VisionaryResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateVisionary extends CreateRecord
{
    protected static string $resource = VisionaryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Save बटन
    protected function getCreateFormAction(): Action
    {
        return Action::make('save')
            ->label('Save')
            ->submit('create')
            ->color('primary');
    }

    // Cancel बटन
    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label('Cancel')
            ->url($this->getResource()::getUrl('index'))
            ->color('secondary')
            ->outlined();
    }

    // Actions सेट करना
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }
}
