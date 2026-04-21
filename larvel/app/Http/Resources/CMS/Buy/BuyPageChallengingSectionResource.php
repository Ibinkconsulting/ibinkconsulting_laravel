<?php

namespace App\Http\Resources\CMS\Buy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyPageChallengingSectionResource extends JsonResource
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
            'parts'     => $this->v1 ? json_decode($this->v1, true) : [],
        ];
    }
}
