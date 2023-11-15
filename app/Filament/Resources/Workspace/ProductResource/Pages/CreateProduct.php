<?php

namespace App\Filament\Resources\Workspace\ProductResource\Pages;

use App\Filament\Resources\Workspace\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
