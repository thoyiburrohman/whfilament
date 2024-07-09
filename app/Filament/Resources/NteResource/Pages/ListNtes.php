<?php

namespace App\Filament\Resources\NteResource\Pages;

use App\Filament\Imports\NteImporter;
use App\Filament\Resources\NteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNtes extends ListRecords
{
    protected static string $resource = NteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Stock'),
            Actions\ImportAction::make()
                ->label('Upload')
                ->icon('heroicon-s-cloud-arrow-up')
                ->color('success')
                ->visible(Auth()->user()->hasRole('super_admin'))
                ->importer(NteImporter::class),

        ];
    }
}
