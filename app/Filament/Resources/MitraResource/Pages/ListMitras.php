<?php

namespace App\Filament\Resources\MitraResource\Pages;

use App\Filament\Imports\MitraImporter;
use App\Filament\Resources\MitraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMitras extends ListRecords
{
    protected static string $resource = MitraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Mitra'),
            Actions\ImportAction::make()
                ->icon('heroicon-s-cloud-arrow-up')
                ->color('success')
                ->label('Upload')
                ->visible(Auth()->user()->hasRole('super_admin'))
                ->importer(MitraImporter::class),
            Actions\ImportAction::make()
                ->icon('heroicon-s-cloud-arrow-down')
                ->color('info')
                ->label('Download')
                ->visible(Auth()->user()->hasRole('super_admin'))
                ->importer(MitraImporter::class)
        ];
    }
}
