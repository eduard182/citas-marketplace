<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
   protected $fillable = [
    'booking_id',
    'amount_clp',
    'status',
    'provider',
    'provider_ref',
    'buy_order',
    'session_id',
];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
