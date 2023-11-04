<?php

namespace App\Filament\Resources\Configs\EconomicCategoryResource\Pages;

use App\Filament\Resources\Configs\EconomicCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEconomicCategories extends ManageRecords
{
    protected static string $resource = EconomicCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
