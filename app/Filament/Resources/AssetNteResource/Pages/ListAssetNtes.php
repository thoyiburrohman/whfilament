<?php

namespace App\Filament\Resources\AssetNteResource\Pages;

use App\Filament\Imports\AssetNteImporter;
use App\Filament\Resources\AssetNteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use PhpParser\Node\Stmt\Label;

class ListAssetNtes extends ListRecords
{
    protected static string $resource = AssetNteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Asset NTE'),
            Actions\ImportAction::make()
                ->icon('heroicon-s-cloud-arrow-up')
                ->color('success')
                ->label('Upload')
                ->visible(Auth()->user()->hasRole('super_admin'))
                ->importer(AssetNteImporter::class),
            // Actions\ImportAction::make()
            //     ->icon('heroicon-s-cloud-arrow-down')
            //     ->color('info')
            //     ->label('Download')
            //     ->visible(Auth()->user()->hasRole('super_admin')),
            // ->importer(MitraImporter::class)
        ];
    }
}
