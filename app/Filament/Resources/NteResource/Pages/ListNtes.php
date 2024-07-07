<?php

namespace App\Filament\Resources\NteResource\Pages;

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
        ];
    }
}
