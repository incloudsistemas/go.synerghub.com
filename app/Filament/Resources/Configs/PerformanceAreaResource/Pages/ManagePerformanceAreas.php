<?php

namespace App\Filament\Resources\Configs\PerformanceAreaResource\Pages;

use App\Filament\Resources\Configs\PerformanceAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePerformanceAreas extends ManageRecords
{
    protected static string $resource = PerformanceAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
