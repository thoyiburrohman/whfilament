<?php

namespace App\Filament\Resources\WarehouseResource\Pages;

use App\Filament\Imports\WarehouseImporter;
use App\Filament\Resources\WarehouseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWarehouses extends ListRecords
{
    protected static string $resource = WarehouseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Warehouse'),
            Actions\ImportAction::make()
                ->icon('heroicon-s-cloud-arrow-up')
                ->color('success')
                ->label('Upload')
                ->visible(Auth()->user()->hasRole('super_admin'))
                ->importer(WarehouseImporter::class),
            Actions\ImportAction::make()
                ->icon('heroicon-s-cloud-arrow-down')
                ->color('info')
                ->label('Download')
                ->visible(Auth()->user()->hasRole('super_admin'))
                ->importer(WarehouseImporter::class)
        ];
    }
}
