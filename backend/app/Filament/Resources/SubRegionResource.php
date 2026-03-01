<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubRegionResource\Pages;
use App\Models\SubRegion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubRegionResource extends Resource
{
    protected static ?string $model = SubRegion::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Vùng miền';
    protected static ?string $modelLabel = 'Vùng miền';
    protected static ?string $pluralModelLabel = 'Vùng miền';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('region_id')
                ->label('Khu vực')
                ->relationship('region', 'name')
                ->required()
                ->preload()
                ->searchable(),
            Forms\Components\TextInput::make('name')
                ->label('Tên vùng miền')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('sort')
                ->label('Thứ tự')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('region.name')
                    ->label('Khu vực')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên vùng miền')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort')
                    ->label('Thứ tự')
                    ->sortable(),
                Tables\Columns\TextColumn::make('airports_count')
                    ->label('Số sân bay')
                    ->counts('airports'),
            ])
            ->defaultSort('sort')
            ->filters([
                Tables\Filters\SelectFilter::make('region_id')
                    ->label('Khu vực')
                    ->relationship('region', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubRegions::route('/'),
            'create' => Pages\CreateSubRegion::route('/create'),
            'edit' => Pages\EditSubRegion::route('/{record}/edit'),
        ];
    }
}
