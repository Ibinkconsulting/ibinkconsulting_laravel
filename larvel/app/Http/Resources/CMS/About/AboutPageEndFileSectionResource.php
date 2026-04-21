<?php

namespace App\Http\Resources\CMS\About;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutPageEndFileSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'image' => $this->image,
            'video' => $this->video,
            'duration' => $this->duration,
        ];
    }
}
