<?php

namespace App\Models\JobProfiles;

use App\Models\Concerns\Publishable;
use App\Models\User;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};

class JobProfile extends Model
{
    use HasFactory,
        Publishable;

    const SKILLS = [
        'civil-engineer' => 'Ingeniero Civil',
        'architect' => 'Arquitecto',
        'electrician' => 'Electricista',
        'plumber' => 'Plomero',
        'stone-mason' => 'Albanil',
        'welder' => 'Soldador',
        'painter' => 'Pintor',
        'contractor' => 'Contratista',
        'decorator' => 'Decorador(a)',
        'a-c' => 'Aire Acondicionado',
        'carpenter' => 'Carpintero',
        'plasterer' => 'Yesero',
        'tile-worker' => 'Losetero',
        'blacksmith' => 'Herrero',
        'upholsterer' => 'Tapicero',
        'drywall-worker' => 'Tablaroquero',
        'construction-supervisor' => 'Supervisor de Obra',
        'gardener' => 'Jardinero',
    ];

    protected $casts = ['skills' => 'array', 'status' => 'boolean'];
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

    /* Helpers */

    public static function getSkills() : array
    {
        return self::SKILLS;
    }
}
