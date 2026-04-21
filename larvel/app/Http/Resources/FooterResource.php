<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FooterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'white_logo' => $this->resource['system_setting']?->white_logo
                ? asset($this->resource['system_setting']->white_logo)
                : null,

            'footer_text' => $this->resource['system_setting']?->footer_text,
            'copyright' => $this->resource['system_setting']?->copyright,
            'contact' => [
                'phone' => $this->resource['system_setting']
                    ? ($this->resource['system_setting']->phone_code . ' ' . $this->resource['system_setting']->phone_number)
                    : null,
                'email' => $this->resource['system_setting']?->email,
            ],

            'social_media' => collect($this->resource['social_media'])
                ->map(function ($url) {
                    return $url;
                })
                ->values()
                ->all(),
        ];
    }
}