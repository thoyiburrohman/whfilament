<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NteResource\Pages;
use App\Filament\Resources\NteResource\RelationManagers;
use App\Models\Nte;
use App\Models\Warehouse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NteResource extends Resource
{
    // Model
    protected static ?string $model = Nte::class;

    // Icon
    protected static ?string $navigationIcon = 'heroicon-o-wifi';

    // Icon Active
    protected static ?string $activeNavigationIcon = 'heroicon-c-wifi';

    // Label
    protected static ?string $navigationLabel = 'Stock';

    // Label Navigation Group
    protected static ?string $navigationGroup = 'NTE';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('warehouse_id')
                    ->relationship('warehouse', 'name')
                    ->preload()
                    ->searchable()
                    ->label('Warehouse')
                    ->default(Auth()->user()->warehouse->name)
                    ->required(),
                Forms\Components\Select::make('asset_nte_id')
                    ->relationship('assetNte', 'name')
                    ->preload()
                    ->searchable()
                    ->label('Type')
                    ->required(),
                Forms\Components\TextInput::make('serial_number')
                    ->required(),
                Forms\Components\Select::make('owner')
                    ->options([
                        'EBIS' => 'EBIS',
                        'TSEL' => 'TSEL',
                    ])
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'AVAILABLE' => 'AVAILABLE',
                        'UNVAILABLE' => 'UNVAILABLE',
                        'DISMANTLE' => 'DISMANTLE',
                    ])
                    ->default('AVAILABLE')
                    ->searchable()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('note')
                    ->default('READY TO USE')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('warehouse.name')
                    ->label('Warehouse')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assetNte.name')
                    ->label('Type')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner')
                    ->searchable()
                    ->summarize(Count::make()->label('EBIS')),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->color('warning'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNtes::route('/'),
            'create' => Pages\CreateNte::route('/create'),
            'edit' => Pages\EditNte::route('/{record}/edit'),
        ];
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
