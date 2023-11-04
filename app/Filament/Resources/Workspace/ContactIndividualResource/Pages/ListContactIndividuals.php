<?php

namespace App\Filament\Resources\Workspace\ContactIndividualResource\Pages;

use App\Filament\Resources\Workspace\ContactIndividualResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactIndividuals extends ListRecords
{
    protected static string $resource = ContactIndividualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
