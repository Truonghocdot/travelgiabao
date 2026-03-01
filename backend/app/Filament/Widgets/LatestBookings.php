<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BookingResource;
use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBookings extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Đơn hàng mới nhất';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Booking::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('booking_code')
                    ->label('Mã đơn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flight_number')
                    ->label('Chuyến bay'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Giá vé')
                    ->money('VND')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày đặt')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Xem chi tiết')
                    ->url(fn(Booking $record): string => BookingResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
