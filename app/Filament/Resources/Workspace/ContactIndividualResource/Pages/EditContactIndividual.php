<?php

namespace App\Filament\Resources\Workspace\ContactIndividualResource\Pages;

use App\Filament\Resources\Workspace\ContactIndividualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactIndividual extends EditRecord
{
    protected static string $resource = ContactIndividualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
