<?php

namespace App\Filament\Resources\Workspace\ContactLegalEntityResource\Pages;

use App\Filament\Resources\Workspace\ContactLegalEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactLegalEntity extends EditRecord
{
    protected static string $resource = ContactLegalEntityResource::class;

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
