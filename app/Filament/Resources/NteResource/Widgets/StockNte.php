<?php

namespace App\Filament\Resources\NteResource\Widgets;

use App\Models\AssetNte;
use App\Models\Nte;
use Filament\Forms\Components\Builder;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class StockNte extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(AssetNte::query())
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Item Description')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tsel')
                    ->label('Tsel')
                    ->getStateUsing(function (AssetNte $record) {
                        $total = 0;
                        foreach ($record->nte as $nte) { // Iterasi melalui koleksi 'ntes'
                            $total = totalItemAssetNteTselGudang($nte->asset_nte_id, $nte->warehouse_id);
                        }
                        if ($total) {
                            return $total;
                        };
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('Ebis')
                    ->label('Ebis')
                    ->getStateUsing(function (AssetNte $record) {
                        $total = 0;
                        foreach ($record->nte as $nte) { // Iterasi melalui koleksi 'ntes'
                            $total = totalItemAssetNteEbisGudang($nte->asset_nte_id, $nte->warehouse_id);
                        }
                        if ($total) {
                            return $total;
                        };
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();
        if ($user && $user->hasRole('SO')) {
            $query->where('warehouse_id', $user->warehouse_id);
        }

        return $query;
    }
}
