<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model {

    protected $table = 'sessions';

    protected $fillable = [
        'restaurant_id',
        'duration',
        'start_time',
    ];

    public function restaurants(): BelongsTo
    {

        return $this->belongsTo(Restaurant::class);

    }

}
