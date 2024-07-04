<?php

namespace App\Filament\Resources\AssetNteResource\Pages;

use App\Filament\Resources\AssetNteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetNtes extends ListRecords
{
    protected static string $resource = AssetNteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
