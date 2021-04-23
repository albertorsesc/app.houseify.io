<?php

namespace App\Http\Resources\Businesses;

use App\Http\Resources\LocationResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->slug,
            'owner' => new UserResource($this->whenLoaded('owner')),
            'categories' => $this->categories,
            'email' => $this->email,
            'phone' => $this->phone,
            'site' => $this->site,
            'facebookProfile' => $this->facebook_profile,
            'linkedinProfile' => $this->linkedin_profile,
            'comments' => $this->comments,
            'location' => new LocationResource($this->whenLoaded('location')),
            'interests' => $this->whenLoaded('interests'),
            'likes' => $this->whenLoaded('likes'),
            'status' => $this->status,
            'logo' => $this->logo,
            'meta' => [
                'profile' => $this->profile(),
                'updatedAt' => $this->updated_at->diffForHumans()
            ]
        ];
    }
}
