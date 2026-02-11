<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function providerProfile()
{
    return $this->hasOne(\App\Models\ProviderProfile::class);
}


public function services()
{
    return $this->hasMany(\App\Models\Service::class, 'provider_id');
}



public function availabilityRules()
{
    return $this->hasMany(\App\Models\AvailabilityRule::class, 'provider_id');
}


public function bookingsAsClient()
{
    return $this->hasMany(\App\Models\Booking::class, 'client_id');
}

public function bookingsAsProvider()
{
    return $this->hasMany(\App\Models\Booking::class, 'provider_id');
}


}
