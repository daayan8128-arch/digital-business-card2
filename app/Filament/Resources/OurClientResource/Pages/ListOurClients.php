<?php

namespace App\Filament\Resources\OurClientResource\Pages;

use App\Filament\Resources\OurClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOurClients extends ListRecords
{
    protected static string $resource = OurClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('sampleListOurClients')
                ->label('Our Clients Sample') // Button ka naam
                ->color('primary')  // color: primary, success, danger etc.
                ->icon('heroicon-o-information-circle') // koi bhi heroicon
                ->url('/hardiksengar'),
        ];
    }
}
