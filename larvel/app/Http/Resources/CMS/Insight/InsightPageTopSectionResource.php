<?php

namespace App\Http\Resources\CMS\Insight;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsightPageTopSectionResource extends JsonResource
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
            'sub_title' => $this->sub_title,
            'type' => $this->type,
            'image' => $this->image,
            'video' => $this->video,
            'duration' => $this->duration,
        ];
    }
}
