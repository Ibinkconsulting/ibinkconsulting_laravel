<?php

namespace App\Http\Resources\CMS\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvisorSectionResource extends JsonResource
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
        ];
    }
}
