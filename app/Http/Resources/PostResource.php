<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'img' => $this->img,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'category_title' => $this->category()->first()->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'stories' => $this->stories()->get(),
        ];
    }
}
