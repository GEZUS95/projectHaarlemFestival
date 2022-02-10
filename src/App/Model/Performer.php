<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Performer extends Model {

    protected $table = 'performers';

    protected $fillable = [
        'name',
        'type',
        'description',
        'socials',
    ];

    public function items(): HasMany
    {

        return $this->hasMany(Item::class, 'performer_id');

    }

    public function specialGuestItems(): HasMany
    {

        return $this->hasMany(Item::class, 'special_guest_id');

    }

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Image::class, 'image_ables');
    }
}
