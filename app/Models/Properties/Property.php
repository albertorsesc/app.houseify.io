<?php

namespace App\Models\Properties;

use App\Models\User;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;
use App\Models\Concerns\HandlesMedia;
use App\Models\Concerns\{CanBeReported,
    DeletesRelations,
    HasLocation,
    HasUuid,
    Interestable,
    Locationable,
    Publishable,
    SerializeTimestamps,
    UsesGMaps};
use Illuminate\Database\Eloquent\{Builder, Factories\HasFactory, Model, Relations\BelongsTo, Relations\HasOne};

/**
 * @property boolean status
 * @property integer id
 * @property string title
 * @property string slug
 * @property integer price
 * @property string comments
 * @property string business_type
 * @property string phone
 * @property string email
 * @property Carbon updated_at
 */
class Property extends Model implements Locationable, DeletesRelations
{
    use HasUuid,
        Searchable,
        HasFactory,
        Publishable,
        HasLocation,
        HandlesMedia,
        Interestable,
        CanBeReported,
        SerializeTimestamps;

    protected $casts = ['price' => 'integer', 'status' => 'boolean', 'seller_id' => 'integer'];
    protected $fillable = ['property_category_id', 'business_type', 'title', 'price', 'phone', 'email', 'comments'];

    protected static function boot ()
    {
        parent::boot();
        static::saved(fn ($property) => $property->searchable());
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    /** Relations */

    public function seller() : BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function propertyCategory() : BelongsTo
    {
        return $this->belongsTo(PropertyCategory::class);
    }

    public function propertyFeature() : HasOne
    {
        return $this->hasOne(PropertyFeature::class);
    }

    /* Helpers */

    public function profile() : string
    {
        return route('web.properties.show', $this);
    }

    public function publicProfile() : string
    {
        return route('web.public.properties.show', $this);
    }

    public function formattedPrice() : string
    {
        return '$' . number_format($this->price);
    }

    public static function getReportingCauses() : array
    {
        return array_merge([
            'taken' => 'Propiedad Vendida/Rentada',
            'not-owner' => 'Dueño de la Propiedad incorrecto',
        ], config('houseify.reporting_causes'));
    }

    public function onDelete()
    {
        $this->location()->delete();
        $this->media()->each(fn ($media) => $media->delete());
        $this->reports()->each(fn ($report) => $report->delete());
        $this->interests()->each(fn ($interest) => $interest->delete());
    }

    public function propertyFeatureExists(string $propertyFeature) : int
    {
        return $this->propertyFeature && $this->propertyFeature->features[$propertyFeature] > 0 ?
            (int) $this->propertyFeature->features[$propertyFeature] : 0;
    }

    /**
     * Algolia Instant Search
     * Index Construct
     */
    public function toSearchableArray() : array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => $this->price,
            'formattedPrice' => $this->formattedPrice(),
            'phone' => $this->phone,
            'email' => $this->email,
            'comments' => $this->comments,
            'status' => $this->status,
            'businessType' => $this->business_type,
            'propertyCategory' => [
                'displayName' => $this->propertyCategory->display_name,
                'propertyType' => $this->propertyCategory->propertyType->display_name,
            ],
            'location' => [
                'neighborhood' => $this->location ? $this->location->neighborhood : null,
                'city' => $this->location ? $this->location->city : null,
                'state' => [
                    'name' => $this->location ? $this->location->state->name : null,
                    'code' => $this->location ? $this->location->state->code : null,
                ],
                'fullAddress' => $this->location ? $this->location->getFullAddress() : null
            ] ,
            'propertyFeature' => [
                'propertySize' => $this->propertyFeatureExists('property_size'),
                'constructionSize' => $this->propertyFeatureExists('construction_size'),
                'levelCount' => $this->propertyFeatureExists('level_count'),
                'roomCount' => $this->propertyFeatureExists('room_count'),
                'bathroomCount' => $this->propertyFeatureExists('bathroom_count'),
                'halfBathroomCount' => $this->propertyFeatureExists('half_bathroom_count'),
            ],
            'images' => $this->getMedia(),
            'interests' => $this->interests,
            'meta' => [
                'links' => [
                    'profile' => $this->profile(),
                ],
                'updatedAt' => $this->updated_at->diffForHumans()
            ]
        ];
    }

    public function shouldBeSearchable() : bool
    {
        /*if (app()->environment('testing') || ! config('scout.algolia.is_active')) {
            return false;
        }*/
        return !! $this->status &&
            $this->location &&
            $this->propertyFeature;
    }

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs() : string
    {
        return 'properties';
    }
}
