<?php

namespace App\Filament\Resources\AssetMaterialResource\Pages;

use App\Filament\Resources\AssetMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetMaterial extends EditRecord
{
    protected static string $resource = AssetMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
