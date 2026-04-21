<?php

namespace App\Http\Resources\CMS\Buy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyPageGetClaritySectionResource extends JsonResource
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
            'description' => $this->description,
            'button_text' => $this->button_text,
            'link_url' => $this->link_url,
            'image' => $this->image,
        ];
    }
}
