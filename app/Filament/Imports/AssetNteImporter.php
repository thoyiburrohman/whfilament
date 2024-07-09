<?php

namespace App\Filament\Imports;

use App\Models\AssetNte;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AssetNteImporter extends Importer
{
    protected static ?string $model = AssetNte::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('condition')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('type')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('supplier')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('owner')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?AssetNte
    {
        // return AssetNte::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new AssetNte();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your asset nte import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
