<?php

namespace App\Filament\Resources\HeroPageResource\Pages;

use App\Filament\Resources\HeroPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeroPages extends ListRecords
{
    protected static string $resource = HeroPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('sampleHeroPage')
                ->label('Hero Page Sample') // Button ka naam
                ->color('primary')  // color: primary, success, danger etc.
                ->icon('heroicon-o-information-circle') // koi bhi heroicon
                ->url('/hardiksengar'),
        ];
    }
}
