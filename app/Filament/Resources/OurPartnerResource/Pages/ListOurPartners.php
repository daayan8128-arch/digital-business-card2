<?php

namespace App\Filament\Resources\OurPartnerResource\Pages;

use App\Filament\Resources\OurPartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOurPartners extends ListRecords
{
    protected static string $resource = OurPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('samplelistOurPartners')
                ->label('Our Partners Sample') // Button ka naam
                ->color('primary')  // color: primary, success, danger etc.
                ->icon('heroicon-o-information-circle') // koi bhi heroicon
                ->url('/hardiksengar'),
        ];
    }
}
