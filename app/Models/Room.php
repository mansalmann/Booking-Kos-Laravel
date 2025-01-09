<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'boarding_house_id',
        'name',
        'room_type',
        'square_feet',
        'capacity',
        'price_per_month',
        'is_available',
    ];

    public function boardingHouse():BelongsTo{
        return $this->belongsTo(BoardingHouse::class);
    }

    public function images():HasMany{
        return $this->hasMany(RoomImage::class);
    }

    public function transactions():HasMany{
        return $this->hasMany(Transaction::class);
    }
}
