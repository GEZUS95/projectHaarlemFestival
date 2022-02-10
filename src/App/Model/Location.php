<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    ];

    protected $casts = [
        'seats' => 'integer',
    ];

    public function items(): HasMany
    {

        return $this->hasMany(Item::class, 'location_id');

    }

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Image::class, 'image_ables');
    }

    public function restaurants(): BelongsTo
    {

        return $this->belongsTo(Restaurant::class);

    }

}
