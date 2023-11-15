<?php

namespace App\Filament\Resources\Workspace\InsiderResource\Pages;

use App\Filament\Resources\Workspace\InsiderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInsider extends EditRecord
{
    protected static string $resource = InsiderResource::class;

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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['contactable_type'] = $this->record->contact->contactable_type;

        return $data;
    }
}
