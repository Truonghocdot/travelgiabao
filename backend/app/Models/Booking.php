<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'flight_number',
        'airline_name',
        'origin',
        'destination',
        'departure_time',
        'arrival_time',
        'flight_date',
        'price',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_note',
        'passengers',
        'status',
    ];

    public static function generateBookingCode(): string
    {
        return 'GBT-' . strtoupper(substr(md5(uniqid()), 0, 8));
    }

    public function getPriceFormattedAttribute(): string
    {
        return number_format($this->price, 0, ',', '.') . 'đ';
    }
}
