<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Item extends Model
{

    protected $table = 'items';

    protected $fillable = [
        'program_id',
        'location_id',
        'performer_id',
        'special_guest_id',
        'start_time',
        'end_time',
        'price',
    ];

    protected $casts = [
        'program_id' => 'integer',
        'location_id' => 'integer',
        'performer_id' => 'integer',
        'special_guest_id' => 'integer',
    ];

    public function programs(): BelongsTo
    {

        return $this->belongsTo(Program::class);

    }

    public function location(): BelongsTo
    {

        return $this->belongsTo(Location::class);

    }

    public function performer(): BelongsTo
    {

        return $this->belongsTo(Performer::class);

    }

    public function specialGuest(): BelongsTo
    {

        return $this->belongsTo(Performer::class);

    }

    public function orders(): MorphToMany
    {
        return $this->morphToMany(Order::class, 'order_able', 'order_able');
    }
}
