<?php

namespace App\Filament\Resources\Configs\LegalNatureResource\Pages;

use App\Filament\Resources\Configs\LegalNatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLegalNatures extends ManageRecords
{
    protected static string $resource = LegalNatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
