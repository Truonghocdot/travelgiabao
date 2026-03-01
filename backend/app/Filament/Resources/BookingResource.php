<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Đơn đặt vé';
    protected static ?string $modelLabel = 'Đơn đặt vé';
    protected static ?string $pluralModelLabel = 'Đơn đặt vé';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Thông tin chuyến bay')->schema([
                Forms\Components\TextInput::make('booking_code')->label('Mã đặt vé')->disabled(),
                Forms\Components\TextInput::make('flight_number')->label('Số hiệu'),
                Forms\Components\TextInput::make('airline_name')->label('Hãng bay'),
                Forms\Components\TextInput::make('origin')->label('Điểm đi'),
                Forms\Components\TextInput::make('destination')->label('Điểm đến'),
                Forms\Components\TextInput::make('departure_time')->label('Giờ đi'),
                Forms\Components\TextInput::make('arrival_time')->label('Giờ đến'),
                Forms\Components\TextInput::make('flight_date')->label('Ngày bay'),
                Forms\Components\TextInput::make('price')->label('Giá vé (VNĐ)')->numeric()->prefix('₫'),
            ])->columns(3),
            Forms\Components\Section::make('Thông tin khách hàng')->schema([
                Forms\Components\TextInput::make('customer_name')->label('Họ tên')->required(),
                Forms\Components\TextInput::make('customer_phone')->label('Số điện thoại')->required(),
                Forms\Components\TextInput::make('customer_email')->label('Email'),
                Forms\Components\TextInput::make('passengers')->label('Số hành khách')->numeric()->default(1),
                Forms\Components\Textarea::make('customer_note')->label('Ghi chú')->rows(2),
            ])->columns(2),
            Forms\Components\Select::make('status')
                ->label('Trạng thái')
                ->options([
                    'pending' => '⏳ Chờ xác nhận',
                    'confirmed' => '✅ Đã xác nhận',
                    'cancelled' => '❌ Đã hủy',
                ])
                ->default('pending'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_code')
                    ->label('Mã đặt vé')
                    ->badge()->color('primary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_phone')
                    ->label('SĐT')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flight_number')
                    ->label('Chuyến bay'),
                Tables\Columns\TextColumn::make('origin')
                    ->label('Điểm đi'),
                Tables\Columns\TextColumn::make('destination')
                    ->label('Điểm đến'),
                Tables\Columns\TextColumn::make('flight_date')
                    ->label('Ngày bay'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Giá vé')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.') . 'đ')
                    ->color('success'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
                        'cancelled' => 'Đã hủy',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày đặt')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
                        'cancelled' => 'Đã hủy',
                    ]),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
