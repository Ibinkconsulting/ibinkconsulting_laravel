<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image,
            'order' => $this->order,
            'year' => $this->year,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'category_title' => $this->category?->title,
            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
