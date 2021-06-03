<?php

namespace App\Models;

use App\Models\Businesses\Business;
use App\Models\Concerns\HasAvatar;
use App\Models\JobProfiles\JobProfile;
use App\Models\Properties\Property;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\{Builder,
    Relations\BelongsTo,
    Relations\HasMany,
    Factories\HasFactory,
    Relations\HasOne};
use Laravel\{Sanctum\HasApiTokens,
    Jetstream\HasProfilePhoto,
    Fortify\TwoFactorAuthenticatable,
    Socialite\Facades\Socialite};


class User extends Authenticatable implements MustVerifyEmail
{
    use HasAvatar,
        HasFactory,
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
        'first_name',
        'last_name',
        'email',
        'password',
        'email_verified_at',
        'provider_id',
        'profile_photo_path',
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

    public function businesses() : HasMany
    {
        return $this->hasMany(Business::class, 'owner_id')->latest('updated_at');
    }

    public function jobProfile() : HasOne
    {
        return $this->hasOne(JobProfile::class);
    }

    public function socialAccounts() : HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    /* Scopes */

    public function scopeInterestedProperties() : Builder
    {
        return Property::query()
                       ->with(['propertyCategory.propertyType', 'seller', 'interests', 'location.state', 'media'])
                       ->whereHas('interests', function($query) {
                           return $query->where('interested_by', $this->id);
                       });
    }

    public function scopeInterestedBusinesses() : Builder
    {
        return Business::query()
                       ->with(['owner:id,first_name,last_name', 'interests', 'location.state'])
                       ->whereHas('interests', function($query) {
                           return $query->where('interested_by', $this->id);
                       });
    }

    public function scopeInterestedJobProfiles() : Builder
    {
        return JobProfile::query()
                       ->with(['user:id,first_name,last_name', 'interests', 'location.state'])
                       ->whereHas('interests', function($query) {
                           return $query->where('interested_by', $this->id);
                       });
    }

    /* Helpers */

    public function isRoot() : bool
    {
        return in_array(
            $this->email,
            config('houseify.roles.root')
        );
    }

    /*
    * Use `owns` instead of 'can' policy method because a resource
    * is being return to the view instead of a model and policy methods work with models only.
    *
    * $modelName must be singular.
    * $as: Owns a model As: author, seller, owner, etc.
    * */
    public function owns($model, $as) : bool
    {
        return (int) $this->id === (int) $model->{$as} || $this->isRoot();
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification) : string
    {
        return config('logging.channels.slack.url');
    }

    public function fullName () : string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    public function defaultProfilePhotoUrl() : string
    {
        return $this->getGravatar();
    }
}
