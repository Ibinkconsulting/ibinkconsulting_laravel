<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerPropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => $this->price,
            'location' => $this->location,
            'city' => $this->city,
            'land_size' => $this->land_size,
            'floor_size' => $this->floor_size,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'garages' => $this->garages,
            'open_spaces' => $this->open_spaces,
            'establishment_year' => $this->establishment_year,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'ground_plan_url' => $this->ground_plan
                ? asset($this->ground_plan)
                : null,

            'first_plan_url' => $this->first_plan
                ? asset($this->first_plan)
                : null,

            'apartment_type' => $this->apartment_type,
            'availability' => $this->availability,

            'thumbnail' => $this->thumbnail ? [
                'file_url' => asset($this->thumbnail->file_path),
            ] : null,
            'files' => $this->files
                ? $this->files->map(function ($file) {
                    return [
                        'file_url' => asset($file->file_path),
                    ];
                })
                : [],
            'amenities'         => CoreAmenityResource::collection($this->whenLoaded('amenities')),
        ];
    }
}
