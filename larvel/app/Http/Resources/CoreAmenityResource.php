<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoreAmenityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'icon'  => $this->icon,
        ];
    }
}