<?php

namespace App\Http\Resources\Businesses\Inventory;

use App\Http\Resources\Businesses\BusinessResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'business' => new BusinessResource($this->whenLoaded('business')),
            'name' => $this->name,
            'description' => $this->description,
            'inStock' => $this->in_stock,
            'storageUnit' => $this->storage_unit,
            'unitPrice' => $this->unit_price,
        ];
    }
}
