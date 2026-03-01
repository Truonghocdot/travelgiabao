<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    protected $fillable = ['name', 'sort'];

    public function subRegions(): HasMany
    {
        return $this->hasMany(SubRegion::class)->orderBy('sort');
    }
}
