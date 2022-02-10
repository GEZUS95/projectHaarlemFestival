<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model {

    protected $table = 'restaurants';

    protected $fillable = [
        'title',
        'float',
        'menu',
        'logo',
    ];

    protected $casts = [
        'float' => 'float',
    ];

}
