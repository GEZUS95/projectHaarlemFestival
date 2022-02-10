<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Program extends Model {

    protected $table = 'programs';

    protected $fillable = [
        'title',
        'total_price_program',
        'start_time',
        'end_time',
        'color',
        'event_id',
    ];

    protected $casts = [
        'start_time' => 'date',
        'end_time' => 'date',
        'event_id' => 'integer',
    ];

    public function events(): BelongsTo
    {

        return $this->belongsTo(Event::class);

    }

    public function items(): HasMany
    {

        return $this->hasMany(Item::class, 'program_id');

    }

    public function orders(): MorphToMany
    {
        return $this->morphToMany(Order::class, 'order_able', 'order_able');
    }

}
