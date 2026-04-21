<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'price' => $this->price,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'land_size' => $this->land_size,
            'type' => $this->apartment_type,
            'location' => $this->location,
            'availability' => $this->availability,
            'status' => $this->status,

            'thumbnail' => $this->thumbnail?->file_url,

            'created_at' => $this->created_at?->toDateTimeString(),
            'amenities' => CoreAmenityResource::collection($this->whenLoaded('amenities')),
        ];
    }
}
