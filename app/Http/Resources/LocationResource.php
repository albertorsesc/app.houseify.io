<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'locationable' => $this->whenLoaded('locationable'),
            'address' => $this->address,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->whenLoaded('state'),
            'zipCode' => $this->zip_code,
            'fullAddress' => $this->getFullAddress(),
            'coordinates' => $this->coordinates ? [
                'latitude' => $latitude = $this->coordinates['latitude'],
                'longitude' => $longitude = $this->coordinates['longitude'],
            ] : [],
            'gmap' => $this->getGoogleMap(),
        ];
    }
}
