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
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'fullName' => $this->fullName(),
            'email' => $this->email,
            'status' => $this->status,
            'properties' => PropertyResource::collection($this->whenLoaded('properties')),
            'photo' => $this->getAvatar(),
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
