<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'image'
    ];

    public function boardingHouses(): HasMany
    {
        return $this->hasMany(BoardingHouse::class);
    }
}
