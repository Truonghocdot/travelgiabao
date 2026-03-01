<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AirportResource\Pages;
use App\Models\Airport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AirportResource extends Resource
{
    protected static ?string $model = Airport::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Sân bay / Thành phố';
    protected static ?string $modelLabel = 'Sân bay';
    protected static ?string $pluralModelLabel = 'Sân bay / Thành phố';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('sub_region_id')
                ->label('Vùng miền')
                ->relationship('subRegion', 'name')
                ->required()
                ->preload()
                ->searchable(),
            Forms\Components\TextInput::make('name')
                ->label('Tên thành phố / sân bay')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('code')
                ->label('Mã sân bay (IATA)')
                ->required()
                ->maxLength(10),
            Forms\Components\Section::make('Khoảng giá vé')->schema([
                Forms\Components\TextInput::make('base_price')
                    ->label('Giá cơ bản (VNĐ)')
                    ->numeric()
                    ->prefix('₫')
                    ->required(),
                Forms\Components\TextInput::make('min_price')
                    ->label('Giá thấp nhất (VNĐ)')
                    ->numeric()
                    ->prefix('₫')
                    ->required(),
                Forms\Components\TextInput::make('max_price')
                    ->label('Giá cao nhất (VNĐ)')
                    ->numeric()
                    ->prefix('₫')
                    ->required(),
            ])->columns(3),
            Forms\Components\Toggle::make('is_active')
                ->label('Đang hoạt động')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Mã IATA')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Thành phố / Sân bay')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subRegion.name')
                    ->label('Vùng miền')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subRegion.region.name')
                    ->label('Khu vực')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('min_price')
                    ->label('Giá thấp nhất')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.') . 'đ')
                    ->sortable()
                    ->color('success'),
                Tables\Columns\TextColumn::make('max_price')
                    ->label('Giá cao nhất')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.') . 'đ')
                    ->sortable()
                    ->color('danger'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Hoạt động')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sub_region_id')
                    ->label('Vùng miền')
                    ->relationship('subRegion', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Trạng thái'),
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
            'index' => Pages\ListAirports::route('/'),
            'create' => Pages\CreateAirport::route('/create'),
            'edit' => Pages\EditAirport::route('/{record}/edit'),
        ];
    }
}
