<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AirlineResource\Pages;
use App\Models\Airline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AirlineResource extends Resource
{
    protected static ?string $model = Airline::class;
    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $navigationLabel = 'Hãng bay';
    protected static ?string $modelLabel = 'Hãng bay';
    protected static ?string $pluralModelLabel = 'Hãng bay';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Tên hãng bay')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('code')
                ->label('Mã hãng')
                ->required()
                ->maxLength(10),
            Forms\Components\ColorPicker::make('logo_color')
                ->label('Màu logo'),
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
                    ->label('Mã')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên hãng bay')
                    ->searchable(),
                Tables\Columns\ColorColumn::make('logo_color')
                    ->label('Màu'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Hoạt động')
                    ->boolean(),
            ])
            ->filters([])
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
            'index' => Pages\ListAirlines::route('/'),
            'create' => Pages\CreateAirline::route('/create'),
            'edit' => Pages\EditAirline::route('/{record}/edit'),
        ];
    }
}
