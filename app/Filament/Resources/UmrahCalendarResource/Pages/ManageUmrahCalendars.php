<?php

namespace App\Filament\Resources\UmrahCalendarResource\Pages;

use App\Filament\Resources\UmrahCalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUmrahCalendars extends ManageRecords
{
    protected static string $resource = UmrahCalendarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
