<?php

namespace App\Models\JobProfiles;

use App\Models\User;
use Laravel\Scout\Searchable;
use App\Models\Concerns\{DeletesRelations,
    HasLocation,
    Interestable,
    Likeable,
    Publishable,
    CanBeReported,
    SerializeTimestamps};
use Illuminate\Database\Eloquent\{Casts\Attribute, Factories\HasFactory, Model, Relations\BelongsTo};

/**
 * @property boolean status
 */
class JobProfile extends Model implements DeletesRelations
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

    protected static function boot ()
    {
        parent::boot();
        static::saved(fn ($jobProfile) => $jobProfile->searchable());
    }

    public function getRouteKeyName() : string
    {
        return 'uuid';
    }

    /* Relations */

    public function user () : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* Accessors & Mutators */

    protected function skills(): Attribute
    {
        return new Attribute(
            set: fn ($value) => json_encode($value),
        );
    }

    /* Helpers */

    public function onDelete ()
    {
        $this->location()->delete();
        $this->likes()->each(fn ($like) => $like->delete());
        $this->interests()->each(fn ($interest) => $interest->delete());
        if ($this->photo) \Storage::delete($this->photo);
    }

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
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'slug' => $this->slug,
            'skills' => $this->skills,
            'email' => $this->email,
            'phone' => $this->phone,
            'user' => ['fullName' => $this->user->fullName()],
            'status' => $this->status,
            'bio' => $this->bio,
            'photo' => $this->photo,
            'location' => [
                'neighborhood' => $this->location ? $this->location->neighborhood : null,
                'city' => $this->location ? $this->location->city : null,
                'state' => [
                    'name' => $this->location ? $this->location->state->name : null,
                    'code' => $this->location ? $this->location->state->code : null,
                ],
                'fullAddress' => $this->location ? $this->location->getFullAddress() : null,
            ] ,
            'interests' => $this->interests,
            'meta' => [
                'links' => [
                    'profile' => $this->profile(),
                    'publicProfile' => $this->publicProfile(),
                ]
            ]
        ];
    }

    public function shouldBeSearchable() : bool
    {
        /*if (app()->environment('testing') || ! config('scout.algolia.is_active')) {
            return false;
        }*/
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
