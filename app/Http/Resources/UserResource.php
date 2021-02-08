<?php

namespace App\Http\Resources;

use App\Http\Resources\Ads\AdResource;
use App\Http\Resources\Properties\PropertyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            //            'uuid' => $this->uuid,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            //            'phone' => $this->phone,
            'status' => $this->status,
            'properties' => PropertyResource::collection($this->whenLoaded('properties')),
//            'businesses' => BusinessResource::collection($this->whenLoaded('businesses')),
//            'ads' => AdResource::collection($this->whenLoaded('ads')),
            //            'propertyTargets' => PropertyTargetResource::collection($this->whenLoaded('propertyTargets')),
            //            'propertiesCount' => $this->properties->count(),
            /*'meta' => [
                'links' => [
                    'profile' => $this->profile(),
                    'properties' => $this->userPropertiesUrl()
                ],
                'timestamps' => [
                    'createdAt' => optional($this->created_at)->diffForHumans(),
                    'updatedAt' => optional($this->updated_at)->diffForHumans(),
                ]
            ]*/
        ];
    }
}
