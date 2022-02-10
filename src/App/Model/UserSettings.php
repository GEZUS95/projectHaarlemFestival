<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettings extends Model {

    protected $table = 'user_settings';

    protected $fillable = [
        'user_id',
        'settings',
    ];

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);

    }

}
