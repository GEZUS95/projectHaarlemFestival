<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Session extends Model {

    protected $table = 'sessions';

    protected $fillable = [
        'restaurant_id',
        'start_time',
        'end_time',
    ];

    public function restaurants(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders(): MorphToMany
    {
        return $this->morphToMany(Order::class, 'order_able');
    }

}
