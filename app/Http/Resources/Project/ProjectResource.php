<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'category_id'     => $this->category_id,
            'title'           => $this->title,
            'description_one' => $this->description_one,
            'description_two' => $this->description_two,
            'deadline'        => $this->deadline,
            'location'        => $this->location,
            'images'          => $this->getMedia('images')->map(function($media) {
                return [
                    'id'    => $media->id,
                    'url'   => $media->getFullUrl()
                ];
            }),
        ];
    }
}
