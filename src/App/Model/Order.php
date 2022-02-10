<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Order extends Model {

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
    ];

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);

    }

    public function events(): MorphToMany
    {
        return $this->morphedByMany(Event::class, 'order_able', 'order_able');
    }

    public function programs(): MorphToMany
    {
        return $this->morphedByMany(Program::class, 'order_able', 'order_able');
    }

    public function items(): MorphToMany
    {
        return $this->morphedByMany(Item::class, 'order_able', 'order_able');
    }

    public function restaurants(): MorphToMany
    {
        return $this->morphedByMany(Restaurant::class, 'order_able', 'order_able');
    }
}
