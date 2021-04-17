<?php

namespace App\Models\Businesses;

use App\Models\Like;
use App\Models\User;
use Laravel\Scout\Searchable;
use App\Models\Concerns\{CanBeReported, HasLocation, HasUuid, Interestable, Likeable, Publishable, SerializeTimestamps};
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Factories\HasFactory, Relations\MorphMany};

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
        if ($this->owner->id === auth()->id()) {
            return route('web.businesses.show', $this);
        }
        return route('web.public.businesses.show', $this);
    }

    public function publicProfile() : string
    {
        return route('web.public.businesses.show', $this);
    }

    public static function getReportingCauses() : array
    {
        return array_merge([
            'non-existent' => 'Negocio/Empresa inexistente',
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
            return [
                'id' => $this->id,
                'uuid' => $this->uuid,
                'name' => $this->name,
                'slug' => $this->slug,
                'categories' => $this->categories,
                'phone' => $this->phone,
                'comments' => $this->comments,
                'status' => $this->status,
                'location' => [
                    'neighborhood' => $this->location ? $this->location->neighborhood : null,
                    'city' => $this->location ? $this->location->city : null,
                    'state' => [
                        'name' => $this->location ? $this->location->state->name : null,
                        'code' => $this->location ? $this->location->state->code : null,
                    ],
                    'fullAddress' => $this->location->getFullAddress()
                ] ,
//                'images' => $this->images,
//                'interests' => $this->interests,
                'meta' => [
                    'links' => [
                        'profile' => $this->profile()
                    ],
                ]
            ];
        }
        return [];
    }

    public function shouldBeSearchable() : bool
    {
        return $this->isPublished() && $this->location;
    }
}
