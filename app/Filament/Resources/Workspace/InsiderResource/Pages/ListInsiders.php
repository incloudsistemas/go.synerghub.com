<?php

namespace App\Filament\Resources\Workspace\InsiderResource\Pages;

use App\Filament\Resources\Workspace\InsiderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInsiders extends ListRecords
{
    protected static string $resource = InsiderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
