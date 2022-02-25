<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Restaurant extends Model {

    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'location_id',
        'type_id',
        'description',
        'stars',
        'seats',
        'price',
        'price_child',
        'accessibility',
    ];

    protected $casts = [

    ];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(RestaurantType::class, 'restaurant_types_link', 'restaurant_id', 'restaurant_types_id');
    }

    public function locations(): HasOne
    {

        return $this->hasOne(Location::class);

    }

    public function sessions(): HasOne
    {

        return $this->hasOne(Session::class);

    }

    public function orders(): MorphToMany
    {
        return $this->morphToMany(Order::class, 'order_able');
    }
}
