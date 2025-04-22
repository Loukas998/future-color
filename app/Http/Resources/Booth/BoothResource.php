<?php

namespace App\Http\Resources\Booth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoothResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id, 
            'title'       => $this->title,
            'description' => $this->description,
            'images'      => $this->getMedia('images')->map(function($media) {
                return [
                    'id'    => $media->id,
                    'url'   => $media->getFullUrl()
                ];
            }),
        ];
    }
}
