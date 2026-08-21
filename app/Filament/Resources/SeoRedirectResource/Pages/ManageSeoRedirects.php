<?php

namespace App\Filament\Resources\SeoRedirectResource\Pages;

use App\Filament\Resources\SeoRedirectResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSeoRedirects extends ManageRecords
{
    protected static string $resource = SeoRedirectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
