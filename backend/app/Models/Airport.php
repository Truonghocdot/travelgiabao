<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airport extends Model
{
    protected $fillable = ['sub_region_id', 'name', 'code', 'base_price', 'min_price', 'max_price', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function subRegion(): BelongsTo
    {
        return $this->belongsTo(SubRegion::class);
    }

    /**
     * Hiển thị khoảng giá dạng: 890.000đ - 1.602.000đ
     */
    public function getPriceRangeAttribute(): string
    {
        return number_format($this->min_price, 0, ',', '.') . 'đ - ' . number_format($this->max_price, 0, ',', '.') . 'đ';
    }
}
