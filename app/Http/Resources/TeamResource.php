<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'city' => $this->city,
            'abbreviation' => $this->abbreviation,
            'conference' => $this->conference,
            'division' => $this->division,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
