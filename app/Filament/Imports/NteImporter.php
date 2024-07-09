<?php

namespace App\Filament\Imports;

use App\Models\Nte;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class NteImporter extends Importer
{
    protected static ?string $model = Nte::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('warehouse')
                ->relationship(resolveUsing: 'name')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('assetNte')
                ->relationship(resolveUsing: ['name', 'condition'])
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('serial_number')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('owner')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('status')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('note'),
        ];
    }

    public function resolveRecord(): ?Nte
    {
        // return Nte::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Nte();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your nte import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
