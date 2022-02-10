<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model {

    protected $table = 'locations';

    protected $fillable = [
        'name',
        'city',
        'address',
        'stage',
        'color',
        'seats',
        'images',
    ];

    protected $casts = [
        'seats' => 'integer',
    ];

    public function items(): HasMany
    {

        return $this->hasMany(Item::class, 'location_id');

    }

}
