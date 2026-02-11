<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderProfile extends Model
{
    protected $fillable = [
        'user_id', 'slug', 'display_name', 'city', 'timezone', 'bio', 'verified'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
