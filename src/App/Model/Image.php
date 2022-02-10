<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model {

    protected $table = 'images';

    protected $fillable = [
        'file_location',
    ];

    public function events(): MorphToMany
    {
        return $this->morphedByMany(Event::class, 'image_ables');
    }

    public function locations(): MorphToMany
    {
        return $this->morphedByMany(Location::class, 'image_ables');
    }

    public function performers(): MorphToMany
    {
        return $this->morphedByMany(Performer::class, 'image_ables');
    }

}
