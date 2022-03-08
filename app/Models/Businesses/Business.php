<?php

namespace App\Models\Businesses;

use App\Models\User;
use App\Models\Location;
use Laravel\Scout\Searchable;
use App\Models\Businesses\Inventory\Product;
use Illuminate\Database\Eloquent\{Model,
    Relations\BelongsTo,
    Factories\HasFactory,
    Relations\HasMany
};
use App\Models\Concerns\{CanBeReported,
    DeletesRelations,
    HasLocation,
    HasUuid,
    Interestable,
    Likeable,
    Publishable,
    SerializeTimestamps};

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
class Business extends Model implements DeletesRelations
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

    protected static function boot ()
    {
        parent::boot();
        static::saved(fn ($business) => $business->searchable());
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    /* Relations */

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
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
        $this->likes()->each(fn ($like) => $like->delete());
        $this->interests()->each(fn ($interest) => $interest->delete());
        $this->products()->each(fn ($product) => $product->delete());
        if ($this->logo) \Storage::delete($this->logo);
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
            'name' => $this->name,
            'slug' => $this->slug,
            'categories' => $this->categories,
            'phone' => $this->phone,
            'email' => $this->email,
            'comments' => $this->comments,
            'status' => $this->status,
            'location' => [
                'neighborhood' => $this->location ? $this->location->neighborhood : null,
                'city' => $this->location ? $this->location->city : null,
                'state' => [
                    'name' => $this->location ? $this->location->state->name : null,
                    'code' => $this->location ? $this->location->state->code : null,
                ],
                'fullAddress' => $this->location ? $this->location->getFullAddress() : null,
            ] ,
            'logo' => $this->logo,
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
        return 'businesses';
    }
}
