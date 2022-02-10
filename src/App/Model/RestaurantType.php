<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RestaurantType extends Model
{

    protected $table = 'restaurant_types';

    protected $fillable = [
        'type'
    ];

    protected $casts = [

    ];

    public function restaurants(): BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_types_link', 'restaurant_id', 'restaurant_types_id');
    }
}
