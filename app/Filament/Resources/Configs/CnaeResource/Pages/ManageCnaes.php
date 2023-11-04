<?php

namespace App\Filament\Resources\Configs\CnaeResource\Pages;

use App\Filament\Resources\Configs\CnaeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCnaes extends ManageRecords
{
    protected static string $resource = CnaeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
