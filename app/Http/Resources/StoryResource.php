<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
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
            'story_img' => $this->story_img,
            'video' => $this->video,
            'post_id' => $this->post_id,
            'post_title' => $this->post()->first()->title,
            'see_more' => $this->see_more,
            'is_add' => (int)$this->is_add,
            'pub_number' => $this->pub_number,
            'slot_number' => $this->slot_number,
            'ads_script' => $this->ads_script,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
