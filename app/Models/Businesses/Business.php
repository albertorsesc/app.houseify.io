<?php

namespace App\Models\Businesses;

use App\Models\Location;
use App\Models\User;
use Laravel\Scout\Searchable;
use App\Models\Concerns\{CanBeReported, HasLocation, HasUuid, Interestable, Likeable, Publishable, SerializeTimestamps};
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Factories\HasFactory, Relations\MorphMany};

/**
 * @property string status
 * @property string phone
 * @property string email
 * @property string name
 * @property string slug
 * @property string comments
 * @property string logo
 * @property array categories
 * @property string site
 * @property string facebook_profile
 * @property string linkedin_profile
 * @property integer id
 * @property string uuid
 * @property Location location
 */
class Business extends Model
{
    use HasUuid,
        Likeable,
        Searchable,
        HasFactory,
        HasLocation,
        Publishable,
        Interestable,
        CanBeReported,
        SerializeTimestamps;

    protected $casts = ['status' => 'boolean', 'categories' => 'array'];
    protected $fillable = ['name', 'categories', 'email', 'phone', 'site', 'facebook_profile', 'linkedin_profile', 'logo', 'comments'];

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    /* Relations */

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /* Mutators */

    public function setCategoriesAttribute($categories)
    {
        return $this->attributes['categories'] = json_encode($categories);
    }

    /* Helpers */

    public function profile() : string
    {
        return route('web.businesses.show', $this);
    }

    public function publicProfile() : string
    {
        return route('web.public.businesses.show', $this);
    }

    public static function getReportingCauses() : array
    {
        return array_merge([
            'non-existent' => 'Negocio/Empresa inexistente',
            'not-owner' => 'Dueño del Negocio/Empresa incorrecto',
        ], config('houseify.reporting_causes'));
    }

    public function onDelete()
    {
        $this->location()->delete();
    }

    /**
     * Algolia Instant Search
     * Index Construct
     */

    public function toSearchableArray() : array
    {
        if ($this->shouldBeSearchable()) {
            $location = $this->location->fresh();
            $interests = $this->interests->fresh();
            return [
                'id' => $this->id,
                'uuid' => $this->uuid,
                'name' => $this->name,
                'slug' => $this->slug,
                'categories' => $this->categories,
                'phone' => $this->phone,
                'email' => $this->email,
                'comments' => $this->comments,
                'status' => $this->status,
                'location' => [
                    'neighborhood' => $location ? $location->neighborhood : null,
                    'city' => $location ? $location->city : null,
                    'state' => [
                        'name' => $location ? $location->state->name : null,
                        'code' => $location ? $location->state->code : null,
                    ],
                    'fullAddress' => $location->getFullAddress()
                ] ,
                'logo' => $this->logo,
                'interests' => $interests,
                'meta' => [
                    'profile' => $this->profile()
                ]
            ];
        }
        return [];
    }

    public function shouldBeSearchable() : bool
    {
        if (app()->environment('testing') || ! env('ALGOLIA_ON')) {
            return false;
        }
        return !! $this->status && $this->location;
    }
}
