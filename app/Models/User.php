<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->wallet()->create(['balance' => 1000.00]);        
        });
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

   public function aandelen()
{
    return $this->belongsToMany(Aandeel::class, 'user_aandeel')
        ->withPivot('aantal')
        ->withTimestamps();
}

public function etfs()
{
    return $this->belongsToMany(Etf::class, 'user_etf')
        ->withPivot('aantal')
        ->withTimestamps();
}
}
?>


