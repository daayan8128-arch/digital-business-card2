<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
 class ListFeedback extends ListRecords
{
    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
 
            Actions\Action::make('sampleFeedback')
                ->label('Feedback Sample') // Button ka naam
                ->color('primary')  // color: primary, success, danger etc.
                ->icon('heroicon-o-information-circle') // koi bhi heroicon
                ->url('/hardiksengar'),
        ];
    }
}
