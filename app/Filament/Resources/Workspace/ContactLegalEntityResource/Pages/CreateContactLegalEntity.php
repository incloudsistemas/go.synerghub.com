<?php

namespace App\Filament\Resources\Workspace\ContactLegalEntityResource\Pages;

use App\Filament\Resources\Workspace\ContactLegalEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContactLegalEntity extends CreateRecord
{
    protected static string $resource = ContactLegalEntityResource::class;

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
