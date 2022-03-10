<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Event extends Model {

    protected $table = 'events';

    protected $fillable = [
        'title',
        'total_price_event',
        'description',
    ];

    public function programs(): HasMany
    {

        return $this->hasMany(Program::class, 'event_id');

    }

    public function restaurants(): HasMany
    {

        return $this->hasMany(Restaurant::class, 'event_id');

    }

    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'image_ables');
    }

    public function orders(): MorphToMany
    {
        return $this->morphToMany(Order::class, 'order_able', 'order_able');
    }

}
