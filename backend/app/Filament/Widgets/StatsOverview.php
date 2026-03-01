<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Airport;
use App\Models\Blog;
use App\Models\Booking;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tổng lượt đặt vé', Booking::count())
                ->description('Số lượng đơn hàng từ trước đến nay')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),
            Stat::make('Tổng doanh thu', number_format(Booking::sum('price'), 0, ',', '.') . 'đ')
                ->description('Tổng tiền vé đã ghi nhận')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),
            Stat::make('Bài viết & Tin tức', Blog::count())
                ->description('Số lượt blog và tin tức đã đăng')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning'),
            Stat::make('Số lượng sân bay', Airport::count())
                ->description('Tổng số sân bay trong hệ thống')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('info'),
        ];
    }
}
