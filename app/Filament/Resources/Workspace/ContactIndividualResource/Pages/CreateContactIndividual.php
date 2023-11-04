<?php

namespace App\Filament\Resources\Workspace\ContactIndividualResource\Pages;

use App\Filament\Resources\Workspace\ContactIndividualResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContactIndividual extends CreateRecord
{
    protected static string $resource = ContactIndividualResource::class;

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }

    protected function afterCreate(): void
    {
        // Force contact create
        if (!$this->record->contact) {
            $this->record->contact()
                ->create();
        }
    }
}
