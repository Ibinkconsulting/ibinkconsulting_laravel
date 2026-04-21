<?php

namespace App\Http\Resources\CMS\Sell;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellPageSellingProcessSectionResource extends JsonResource
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
            'sub_text' => $this->sub_text,
            'parts'     => $this->v1 ? json_decode($this->v1, true) : [],
            'button_text' => $this->button_text,
            'link_url' => $this->link_url,
        ];
    }
}
