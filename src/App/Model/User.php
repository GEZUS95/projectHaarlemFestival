<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'user';

    protected $fillable = [
        'email',
        'password',
        'role_id'
    ];

}
