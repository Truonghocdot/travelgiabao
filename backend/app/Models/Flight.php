<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'airline_code',
        'airline_name',
        'flight_number',
        'origin_code',
        'origin_name',
        'destination_code',
        'destination_name',
        'departure_time',
        'arrival_time',
        'duration_minutes',
        'aircraft_type',
        'price',
        'day_of_week',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getDurationFormattedAttribute(): string
    {
        $hours = intdiv($this->duration_minutes, 60);
        $mins = $this->duration_minutes % 60;
        return "{$hours} giờ {$mins} phút";
    }

    public function getPriceFormattedAttribute(): string
    {
        return number_format($this->price, 0, ',', ',');
    }
}
