<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FixtureCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'week' => $this->week,
            'home_team' => $this->homeTeam,
            'away_team' => $this->awayTeam,
            'is_played' => $this->is_played,
            'home_team_score' => $this->home_team_score,
            'away_team_score' => $this->away_team_score,
        ];
    }
}
