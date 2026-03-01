<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubRegion extends Model
{
    protected $fillable = ['region_id', 'name', 'sort'];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function airports(): HasMany
    {
        return $this->hasMany(Airport::class)->orderBy('name');
    }
}
