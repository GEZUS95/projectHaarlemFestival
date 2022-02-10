<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{

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

    public function role(): BelongsTo
    {

        return $this->belongsTo(Role::class);

    }

    public function shoppingCards(): HasMany
    {

        return $this->hasMany(ShoppingCard::class, 'user_id');

    }

    public function settings(): HasOne
    {

        return $this->hasOne(UserSettings::class);

    }
}
