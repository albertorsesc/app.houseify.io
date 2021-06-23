<?php

namespace App\Http\Resources\JobProfiles;

use App\Http\Resources\LocationResource;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class JobProfileResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'skills' => $this->skills,
            'email' => $this->email,
            'phone' => $this->phone,
            'facebookProfile' => $this->facebook_profile,
            'linkedinProfile' => $this->linkedin_profile,
            'site' => $this->site,
            'bio' => $this->bio,
            'location' => new LocationResource($this->whenLoaded('location')),
            'likes' => $this->whenLoaded('likes'),
            'interests' => $this->whenLoaded('interests'),
            'status' => $this->status,
            'photo' => $this->photo,
            'meta' => [
                'links' => [
                    'profile' => $this->profile(),
                    'publicProfile' => $this->publicProfile(),
                ]
            ]
        ];
    }
}
