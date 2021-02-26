<?php

namespace App\Models\JobProfiles;

use App\Models\User;
use App\Models\Concerns\Publishable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};

class JobProfile extends Model
{
    use HasFactory,
        Publishable;

    protected $casts = ['skills' => 'array', 'status' => 'boolean', 'birthdate_at' => 'date:Y-m-d'];
    protected $fillable = ['title', 'skills', 'birthdate_at', 'email', 'phone', 'facebook_profile', 'site', 'bio'];

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

    /* Mutators */

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
}
