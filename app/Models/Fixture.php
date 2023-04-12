<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fixture extends Model
{
    protected $fillable = [
        "league_id",
        "week",
        "home_team_id",
        "away_team_id",
        "is_played",
        "home_team_score",
        "away_team_score",
    ];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function scopeByLeagueId(Builder $query, int $leagueId): Builder
    {
        return $query->where("league_id", $leagueId);
    }

    public function scopeByWeek(Builder $query, int $week): Builder
    {
        return $query->where("week", $week);
    }

    public function scopeByHomeTeamId(Builder $query, int $homeTeamId): Builder
    {
        return $query->where("home_team_id", $homeTeamId);
    }

    public function scopeByAwayTeamId(Builder $query, int $awayTeamId): Builder
    {
        return $query->where("away_team_id", $awayTeamId);
    }

    public function scopeByNotPlayedYet(Builder $query): Builder
    {
        return $query->where("is_played", 0);
    }
}
