<?php

namespace App\Http\Resources\CMS\MasterClass;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MasterclassSectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'video' => $this->video,
            'duration' => $this->duration,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'description' => $this->description,
            'button_text' => $this->button_text,
        ];
    }
}
