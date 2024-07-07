<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Imports\MitraImporter;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-c-plus-circle')
                ->label('Tambah User'),
            Actions\ImportAction::make()
                ->icon('heroicon-s-cloud-arrow-up')
                ->color('success')
                ->label('Upload')
                ->visible(Auth()->user()->hasRole('super_admin')),
            // ->importer(MitraImporter::class),
            Actions\ImportAction::make()
                ->icon('heroicon-s-cloud-arrow-down')
                ->color('info')
                ->label('Download')
                ->visible(Auth()->user()->hasRole('super_admin')),
            // ->importer(MitraImporter::class)
        ];
    }
}
