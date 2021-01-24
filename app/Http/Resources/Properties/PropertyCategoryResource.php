<?php

namespace App\Http\Resources\Properties;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyCategoryResource extends JsonResource
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
            'propertyType' => $this->whenLoaded('propertyType'),
            'name' => $this->name,
            'displayName' => $this->display_name,
        ];
    }
}
