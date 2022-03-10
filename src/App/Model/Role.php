<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model {

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'permissions',
    ];

    public function user(): HasMany
    {

        return $this->hasMany(User::class, 'role_id');

    }
}
