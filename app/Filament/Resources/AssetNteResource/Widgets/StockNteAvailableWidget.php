<?php

namespace App\Filament\Resources\AssetNteResource\Widgets;

use App\Models\AssetNte;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class StockNteAvailableWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                AssetNte::query()
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Type'),
                TextColumn::make('ebis_count')
                    ->label('EBIS')
                    ->counts([
                        fn (Builder $query) => $query->where('is_active', true)
                    ]),
            ]);
    }
}
