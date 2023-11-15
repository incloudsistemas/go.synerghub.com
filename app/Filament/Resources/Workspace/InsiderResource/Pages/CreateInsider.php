<?php

namespace App\Filament\Resources\Workspace\InsiderResource\Pages;

use App\Filament\Resources\Workspace\InsiderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInsider extends CreateRecord
{
    protected static string $resource = InsiderResource::class;

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
}
