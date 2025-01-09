<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonus extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'boarding_house_id',
        'image',
        'name',
        'description'
    ];

    public function boardingHouse():BelongsTo{
        return $this->belongsTo(BoardingHouse::class);
    }
}
