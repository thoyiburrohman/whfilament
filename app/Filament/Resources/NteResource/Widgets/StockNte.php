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
            ->query(Nte::query())
            ->columns([
                Tables\Columns\TextColumn::make('warehouse.name')
                    ->label('Warehouse')
                    ->sortable(),
                Tables\Columns\TextColumn::make('assetNte.name')
                    ->label('Type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('zte123')
                    ->label('Tsel')
                    ->getStateUsing(function (Nte $nte, AssetNte $assetNte) {
                        return $assetNte->name === $nte->assetNte->name ? $assetNte->total : 0;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('Ebis')
                    ->label('Ebis')
                    ->getStateUsing(function (Nte $nte, AssetNte $assetNte) {
                        dd($nte->assetNte->name);
                        return $assetNte->name === $nte->assetNte->name ? $assetNte->total : 0;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
