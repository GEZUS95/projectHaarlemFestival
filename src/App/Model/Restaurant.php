<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Restaurant extends Model {

    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'event_id',
        'location_id',
        'description',
        'stars',
        'seats',
        'price',
        'price_child',
        'session_time',
        'accessibility',
    ];

    protected $casts = [

    ];

    public function events(): BelongsTo
    {

        return $this->belongsTo(Event::class);

    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(RestaurantType::class, 'restaurant_types_link', 'restaurant_id', 'restaurant_types_id');
    }

    public function locations(): HasOne
    {

        return $this->hasOne(Location::class);

    }

    public function sessions(): HasMany
    {

        return $this->hasMany(Session::class);

    }

    public function orders(): MorphToMany
    {
        return $this->morphToMany(Order::class, 'order_able');
    }
}
