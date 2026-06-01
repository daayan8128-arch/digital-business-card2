<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

   protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn () => Auth::user()->is_admin == 1 || Auth::user()->is_super_admin == 1),

                Actions\Action::make('sampleContactMessage')
                ->label('Contact Message Sample') // Button ka naam
                ->color('primary')  // color: primary, success, danger etc.
                ->icon('heroicon-o-information-circle') // koi bhi heroicon
                ->url('/hardiksengar/contact'),
        ];
    }
}
