<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCard extends Model {

    protected $table = 'shopping_cards';

    protected $fillable = [
        'user_id',
        'card',
    ];

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);

    }
}
