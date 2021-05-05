<?php

namespace App\Models\JobProfiles;

use App\Models\User;
use Laravel\Scout\Searchable;
use App\Models\Concerns\{HasLocation, Interestable, Likeable, Publishable, CanBeReported, SerializeTimestamps};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};

/**
 * @property boolean status
 */
class JobProfile extends Model
{
    use Likeable,
        HasFactory,
        Searchable,
        hasLocation,
        Publishable,
        Interestable,
        CanBeReported,
        SerializeTimestamps;

    protected $casts = ['skills' => 'array', 'status' => 'boolean',];
    protected $fillable = ['title', 'skills', 'email', 'phone', 'facebook_profile', 'linkedin_profile', 'site', 'bio', 'photo'];

    public function getRouteKeyName() : string
    {
        return 'uuid';
    }

    /* Relations */

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* Mutators */
    public function setSkillsAttribute($skills)
    {
        return $this->attributes['skills'] = json_encode($skills);
    }

    /* Helpers */

    public static function getSkills() : array
    {
        return config('job-profiles.skills');
    }

    public function profile() : string
    {
        return route('web.job-profiles.show', $this);
    }

    public function publicProfile() : string
    {
        return route('web.public.job-profiles.show', $this);
    }

    public static function getReportingCauses () : array
    {
        return array_merge([
        ], config('houseify.reporting_causes'));
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
                'title' => $this->title,
                'slug' => $this->slug,
                'skills' => $this->skills,
                'email' => $this->email,
                'phone' => $this->phone,
                'user' => ['fullName' => $this->user->fullName()],
                'sitio' => $this->sitio,
                'facebookProfile' => $this->facebook_profile,
                'linkedinProfile' => $this->linkedin_profile,
                'bio' => $this->bio,
                'status' => $this->status,
                'photo' => $this->photo,
                'location' => [
                    'neighborhood' => $location ? $location->neighborhood : null,
                    'city' => $location ? $location->city : null,
                    'state' => [
                        'name' => $location ? $location->state->name : null,
                        'code' => $location ? $location->state->code : null,
                    ],
                    'fullAddress' => $location->getFullAddress()
                ] ,
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

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'job_profiles';
    }
}
