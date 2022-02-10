<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $table = 'events';

    protected $fillable = [
        'title',
        'total_price_event',
        'description',
        'images'
    ];

    public function programs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(Program::class, 'event_id');

    }

}
