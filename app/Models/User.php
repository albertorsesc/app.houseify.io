<?php

namespace App\Models;

use App\Models\Properties\Property;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\{Relations\HasMany, Factories\HasFactory};
use Laravel\{Sanctum\HasApiTokens, Jetstream\HasProfilePhoto, Fortify\TwoFactorAuthenticatable};


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory,
        Notifiable,
        HasApiTokens,
        HasProfilePhoto,
        TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /* Relations */

    public function properties() : HasMany
    {
        return $this->hasMany(Property::class, 'seller_id')->latest('updated_at');
    }

    /* Helpers */

    public function isRoot() : bool
    {
        return in_array(
            $this->email,
            config('houseify.roles.root')
        );
    }
}
