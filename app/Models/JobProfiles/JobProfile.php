<?php

namespace App\Models\JobProfiles;

use Carbon\Carbon;
use App\Models\User;
use Laravel\Scout\Searchable;
use App\Models\Concerns\{HasLocation, Publishable, CanBeReported};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};

class JobProfile extends Model
{
    use HasFactory,
        Searchable,
        hasLocation,
        Publishable,
        CanBeReported;

    protected $casts = ['skills' => 'array', 'status' => 'boolean', 'birthdate_at' => 'date:Y-m-d'];
    protected $fillable = ['title', 'skills', 'birthdate_at', 'email', 'phone', 'facebook_profile', 'site', 'bio'];

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

    public function getAge() : int
    {
        return Carbon::parse($this->birthdate_at)->age;
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
            return [
                'id' => $this->id,
                'uuid' => $this->uuid,
                'title' => $this->title,
                'slug' => $this->slug,
                'age' => $this->getAge(),
                'skills' => $this->skills,
                'email' => $this->email,
                'phone' => $this->phone,
                'sitio' => $this->sitio,
                'facebookProfile' => $this->facebook_profile,
                'bio' => $this->bio,
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
