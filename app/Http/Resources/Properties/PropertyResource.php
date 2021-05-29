<?php

namespace App\Http\Resources\Properties;

use App\Http\Resources\LocationResource;
use App\Models\Concerns\InterventionImage\Filters\MediumFilter;
use App\Models\Media;
use Illuminate\Http\Resources\Json\JsonResource;
use Intervention\Image\Image;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => $this->price,
            'formattedPrice' => $this->formattedPrice(),
            'comments' => $this->comments,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => $this->status,
            'businessType' => $this->business_type,
            'propertyCategory' => new PropertyCategoryResource($this->whenLoaded('propertyCategory')),
            'location' => new LocationResource($this->whenLoaded('location')),
            'propertyFeature' => new PropertyFeatureResource($this->whenLoaded('propertyFeature')),
            'seller' => $this->whenLoaded('seller'),
            'interests' => $this->whenLoaded('interests'),
            'images' => $this->whenLoaded('media'),
            'meta' => [
                'links' => [
                    'profile' => $this->profile(),
                    'publicProfile' => $this->publicProfile()
                ],
                'updatedAt' => $this->updated_at->diffForHumans()
            ]
        ];
    }
}
