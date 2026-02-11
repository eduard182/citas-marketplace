<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvailabilityRule extends Model
{
    protected $fillable = [
        'provider_id','weekday','start_time','end_time','slot_step_min','buffer_min','active'
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'provider_id');
    }
}
