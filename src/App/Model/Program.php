<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

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

    public function events(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Event::class);

    }

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(Item::class, 'program_id');

    }

}
