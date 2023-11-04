<?php

namespace App\Filament\Resources\Workspace\ContactLegalEntityResource\Pages;

use App\Filament\Resources\Workspace\ContactLegalEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactLegalEntities extends ListRecords
{
    protected static string $resource = ContactLegalEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
