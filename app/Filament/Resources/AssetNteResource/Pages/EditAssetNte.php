<?php

namespace App\Filament\Resources\AssetNteResource\Pages;

use App\Filament\Resources\AssetNteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetNte extends EditRecord
{
    protected static string $resource = AssetNteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
