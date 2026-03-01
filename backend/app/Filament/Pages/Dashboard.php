<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BookingChart;
use App\Filament\Widgets\LatestBookings;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as PagesDashboard;

class Dashboard extends PagesDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function getWidgets(): array
    {
        return [
            BookingChart::class,
            LatestBookings::class,
            StatsOverview::class,
        ];
    }
}
