<?php

namespace App\Http\Resources\CMS\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomePageComingSoonSectionResource extends JsonResource
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
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'button_text' => $this->button_text,
            'link_url' => $this->link_url,
        ];
    }
}
