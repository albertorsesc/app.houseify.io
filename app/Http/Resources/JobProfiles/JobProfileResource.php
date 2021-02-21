<?php

namespace App\Http\Resources\JobProfiles;

use App\Http\Resources\UserResource;
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
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'skills' => $this->skills,
            'birthdateAt' => $this->birthdate_at,
            'email' => $this->email,
            'phone' => $this->phone,
            'facebookProfile' => $this->facebook_profile,
            'site' => $this->site,
            'bio' => $this->bio,
        ];
    }
}
