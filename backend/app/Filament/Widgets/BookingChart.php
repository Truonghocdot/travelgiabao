<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class BookingChart extends ChartWidget
{
    protected static ?string $heading = 'Thống kê đơn hàng (30 ngày qua)';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Booking::selectRaw('DATE(created_at) as date, count(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');

        $labels = [];
        $values = [];

        for ($i = 30; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('d/m');
            $values[] = $data[$date] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Số lượng đơn hàng',
                    'data' => $values,
                    'fill' => 'start',
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
