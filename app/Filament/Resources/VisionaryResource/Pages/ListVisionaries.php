<?php

namespace App\Filament\Resources\VisionaryResource\Pages;

use App\Filament\Resources\VisionaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisionaries extends ListRecords
{
    protected static string $resource = VisionaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('sampleVisionaries')
                ->label('Visionaries Sample') // Button ka naam
                ->color('primary')  // color: primary, success, danger etc.
                ->icon('heroicon-o-information-circle') // koi bhi heroicon
                ->url('/hardiksengar/visionary'),
        ];
    }
}
