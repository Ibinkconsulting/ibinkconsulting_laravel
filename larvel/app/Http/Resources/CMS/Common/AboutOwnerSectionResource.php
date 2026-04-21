<?php

namespace App\Http\Resources\CMS\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutOwnerSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'logo' => $this->logo,
            'title' => $this->title,
            'sub_description' => $this->sub_description,
            'description' => $this->description,
            'button_text' => $this->button_text,
            'link_url' => $this->link_url,
            'image' => $this->image,
            'icon' => $this->icon,
        ];
    }
}
