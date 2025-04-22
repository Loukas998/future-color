<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'whatsapp_link'     => $this->whatsapp_link,
            'printed_projects'  => $this->printed_projects,
            'printing_services' => $this->printing_services,
            'clients'           => $this->clients,
            'email'             => $this->email,
            'phone_number'      => $this->phone_number,
            'location'          => $this->location
        ];
    }
}
