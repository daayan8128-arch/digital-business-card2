<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ViewMedia extends ViewRecord
{
    protected static string $resource = MediaResource::class;

    protected function authorizeAccess(): void
    {
        $record = $this->getRecord();

        // ✅ If user is not owner and not admin, deny access
        if (!$record || ($record->user_id !== auth()->id() && !auth()->user()->is_admin)) {
            abort(403); // Forbidden
        }

        
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('sampleAboutUs')
                ->label('About Us Semple') // Button ka naam
                ->color('primary')  // color: primary, success, danger etc.
                ->icon('heroicon-o-information-circle') // koi bhi heroicon
                ->url('/hardiksenger/about-us'),
        ];
    }
}
