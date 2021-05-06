<?php

namespace App\Models\Properties;

use App\Models\User;
use Laravel\Scout\Searchable;
use App\Models\Concerns\HandlesMedia;
use App\Models\Concerns\{CanBeReported,
    DeletesRelations,
    HasLocation,
    HasUuid,
    Interestable,
    Locationable,
    Publishable,
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
 * @property string updated_at
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
        CanBeReported;

    protected $casts = ['price' => 'integer', 'status' => 'boolean', 'seller_id' => 'integer'];
    protected $fillable = ['property_category_id', 'business_type', 'title', 'price', 'phone', 'email', 'comments'];

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

    /**
     * Algolia Instant Search
     * Index Construct
     */
    public function toSearchableArray() : array
    {
        $location = $this->location->fresh();
        $interests = $this->interests->fresh();
        $propertyFeature = $this->propertyFeature->fresh();

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
                'neighborhood' => $location ? $location->neighborhood : null,
                'city' => $location ? $location->city : null,
                'state' => [
                    'name' => $location ? $location->state->name : null,
                    'code' => $location ? $location->state->code : null,
                ],
                'fullAddress' => $location->getFullAddress()
            ] ,
            'propertyFeature' => [
                'propertySize' => $propertyFeature ? (int) $propertyFeature->features['property_size'] : null,
                'constructionSize' => $propertyFeature ? (int) $propertyFeature->features['construction_size'] : null,
                'levelCount' => $propertyFeature ? (int) $propertyFeature->features['level_count'] > 0 ? (int) $propertyFeature->features['level_count'] : '' : null,
                'roomCount' => $propertyFeature ? (int) $propertyFeature->features['room_count']  > 0 ? (int) $propertyFeature->features['room_count'] : '' : null,
                'bathroomCount' => $propertyFeature ? (int) $propertyFeature->features['bathroom_count'] > 0 ? (int) $propertyFeature->features['bathroom_count'] : '' : null,
                'halfBathroomCount' => $propertyFeature ? (int) $propertyFeature->features['half_bathroom_count'] > 0 ? (int) $propertyFeature->features['half_bathroom_count'] : '' : null,
            ],
            'images' => $this->getMedia(),
            'interests' => $interests,
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
        if (app()->environment('testing') || ! env('ALGOLIA_ON')) {
            return false;
        }
        return !! $this->status &&
            $this->location &&
            $this->propertyFeature;
    }

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'properties';
    }
}
