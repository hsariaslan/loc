<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeagueTable extends Model
{
    protected $fillable = [
        "league_id",
        "team_id",
        "championship_prediction",
        "games",
        "point",
        "wins",
        "loses",
        "draws",
        "goal_difference",
    ];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeByLeagueId(Builder $query, int $leagueId): Builder
    {
        return $query->where("league_id", $leagueId);
    }

    public function scopeByTeamId(Builder $query, int $teamId): Builder
    {
        return $query->where("team_id", $teamId);
    }
}
