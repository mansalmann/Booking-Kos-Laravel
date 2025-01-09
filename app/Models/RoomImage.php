<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'room_id',
        'image'
    ];
    
    public function room():BelongsTo{
        return $this->belongsTo(Room::class);
    }
}
