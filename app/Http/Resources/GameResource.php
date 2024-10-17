<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'home_team' => new TeamResource($this->homeTeam),
            'visitor_team' => new TeamResource($this->visitorTeam),
            'home_team_score' => $this->home_team_score,
            'visitor_team_score' => $this->visitor_team_score,
            'game_date' => $this->game_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
