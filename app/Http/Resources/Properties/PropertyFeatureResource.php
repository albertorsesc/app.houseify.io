<?php

namespace App\Http\Resources\Properties;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyFeatureResource extends JsonResource
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
            'features' => [
                'property_size' => $this->features['property_size'],
                'construction_size' => $this->features['construction_size'],
                'level_count' => $this->features['level_count'],
                'room_count' => $this->features['room_count'],
                'bathroom_count' => $this->features['bathroom_count'],
                'half_bathroom_count' => $this->features['half_bathroom_count'],
            ]
        ];
    }
}
