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

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'role_id' => 'integer',
    ];

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Role::class);

    }
}
