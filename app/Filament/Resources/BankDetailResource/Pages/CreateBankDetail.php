<?php

namespace App\Filament\Resources\BankDetailResource\Pages;

use App\Filament\Resources\BankDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBankDetail extends CreateRecord
{
    protected static string $resource = BankDetailResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
protected function getFormActions(): array
{
    return [
        \Filament\Actions\Action::make('save')
            ->label('Save')
            ->submit('create'),
        \Filament\Actions\Action::make('cancel')
            ->label('Cancel')
            ->url($this->getResource()::getUrl('index')),
    ];
}

    /**
     * Create button ka label change karega ("Save" instead of "Create")
     */
    protected function getCreateFormActionLabel(): string
    {
        return 'Save';
    }

    /**
     * "Create & create another" option ko hatane ke liye
     */
    protected function hasCreateAnother(): bool
    {
        return false;
    }
}
