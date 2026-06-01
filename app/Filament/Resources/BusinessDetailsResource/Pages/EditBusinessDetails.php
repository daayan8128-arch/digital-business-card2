<?php

namespace App\Filament\Resources\BusinessDetailsResource\Pages;

use App\Filament\Resources\BusinessDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessDetails extends EditRecord
{
    protected static string $resource = BusinessDetailsResource::class;
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
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = auth()->user();
        if (!$user->isSuperAdmin() && $data['user_id'] != $user->id) {
            abort(403); // prevent access
        }
        return $data;
    }

}
