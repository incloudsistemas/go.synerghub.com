<?php

namespace App\Filament\Resources\Configs\CorporateQualificationResource\Pages;

use App\Filament\Resources\Configs\CorporateQualificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCorporateQualifications extends ManageRecords
{
    protected static string $resource = CorporateQualificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
