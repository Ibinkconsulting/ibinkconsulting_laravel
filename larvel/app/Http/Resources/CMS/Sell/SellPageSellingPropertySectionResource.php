<?php

namespace App\Http\Resources\CMS\Sell;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellPageSellingPropertySectionResource extends JsonResource
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
        ];
    }
}
