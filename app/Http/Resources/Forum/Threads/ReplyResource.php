<?php

namespace App\Http\Resources\Forum\Threads;

use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Carbon created_at
 */
class ReplyResource extends JsonResource
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
            'thread' => new ThreadResource($this->whenLoaded('thread')),
            'author' => new UserResource($this->whenLoaded('author')),
            'body' => $this->body,
            'meta' => [
                'createdAt' => $this->created_at->diffForHumans(),
            ]
        ];
    }
}
