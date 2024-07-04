<?php

namespace App\Filament\Resources\AssetMaterialResource\Pages;

use App\Filament\Resources\AssetMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetMaterials extends ListRecords
{
    protected static string $resource = AssetMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
