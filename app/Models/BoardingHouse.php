<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BoardingHouse extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'city_id',
        'category_id',
        'gender',
        'description',
        'price',
        'address',
    ];

    public function city():BelongsTo{
        return $this->belongsTo(City::class);
    }

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function rooms():HasMany{
        return $this->hasMany(Room::class);
    }

    public function bonuses():HasMany{
        return $this->hasMany(Bonus::class);
    }

    public function testimonials():HasMany{
        return $this->hasMany(Testimonial::class)->orderBy('created_at', 'desc');;
    }
    public function transactions():HasMany{
        return $this->hasMany(Transaction::class);
    }

}
