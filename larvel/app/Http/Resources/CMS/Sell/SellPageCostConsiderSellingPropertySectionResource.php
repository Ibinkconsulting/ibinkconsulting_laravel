<?php

namespace App\Http\Resources\CMS\Sell;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellPageCostConsiderSellingPropertySectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'main_text' => $this->main_text,
            'description' => $this->description,
            'image' => $this->image,
            'parts' => collect($this->v1 ? json_decode($this->v1, true) : [])->map(function ($part) {
                return [
                    'key_title' => $part['key_title'] ?? null,
                    'points' => collect($part['points'] ?? [])->map(fn($p) => $p['point_title'] ?? '')->filter()->values()->all(),
                ];
            })->filter(fn($p) => !empty($p['key_title']) && !empty($p['points']))->values()->all(),
        ];
    }
}
