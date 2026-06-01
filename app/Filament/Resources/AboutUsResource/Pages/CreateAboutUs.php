<?php

namespace App\Filament\Resources\AboutUsResource\Pages;

use App\Filament\Resources\AboutUsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutUs extends CreateRecord
{
    protected static string $resource = AboutUsResource::class;

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('create')
                ->label('Save') // 👈 Yaha "Create" ki jagah "Save"
                ->submit('create'),
        ];
    }
      protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
