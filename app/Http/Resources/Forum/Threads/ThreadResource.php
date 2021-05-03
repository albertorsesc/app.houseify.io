<?php

namespace App\Http\Resources\Forum\Threads;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
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
            'author' => new UserResource($this->whenLoaded('author')),
            'title' => $this->title,
            'body' => $this->body,
            'replies' => ReplyResource::collection($this->whenLoaded('replies')),
            'meta' => [
                'createdAt' => optional($this->created_at)->diffForHumans()
            ]
        ];
    }
}
