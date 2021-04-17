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
    Publishable};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo, Relations\HasOne};

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
    protected $fillable = ['property_category_id', 'business_type', 'title', 'price', 'comments'];

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
        if ($this->shouldBeSearchable()) {
            return [
                'id' => $this->id,
                'uuid' => $this->uuid,
                'title' => $this->title,
                'slug' => $this->slug,
                'price' => (int) $this->price,
                'formattedPrice' => $this->formattedPrice(),
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
                        'name' => $this->location ? $this->location->state->name : null
                    ],
                    'fullAddress' => $this->location->getFullAddress()
                ] ,
                'propertyFeature' => [
                    'propertySize' => $this->propertyFeature ? (int) $this->propertyFeature->features['property_size'] : null,
                    'constructionSize' => $this->propertyFeature ? (int) $this->propertyFeature->features['construction_size'] : null,
                    'levelCount' => $this->propertyFeature ? (int) $this->propertyFeature->features['level_count'] > 0 ? (int) $this->propertyFeature->features['level_count'] : '' : null,
                    'roomCount' => $this->propertyFeature ? (int) $this->propertyFeature->features['room_count']  > 0 ? (int) $this->propertyFeature->features['room_count'] : '' : null,
                    'bathroomCount' => $this->propertyFeature ? (int) $this->propertyFeature->features['bathroom_count'] > 0 ? (int) $this->propertyFeature->features['bathroom_count'] : '' : null,
                    'halfBathroomCount' => $this->propertyFeature ? (int) $this->propertyFeature->features['half_bathroom_count'] > 0 ? (int) $this->propertyFeature->features['half_bathroom_count'] : '' : null,
                ],
                'images' => $this->images,
                'interests' => $this->interests,
                'seller' => [
                    'meta' => [
                        'profile' => $this->profile()
                    ]
                ],
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
        return $this->isPublished() &&
            $this->location &&
            $this->propertyFeature;
    }
}
