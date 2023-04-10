<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function homeTeam(): HasOne
    {
        return $this->hasOne(Fixture::class, 'home_team_id');
    }

    public function awayTeam(): HasOne
    {
        return $this->hasOne(Fixture::class, 'away_team_id');
    }

    public function scopeByLeagueId(Builder $query, int $leagueId): Builder
    {
        return $query->where("league_id", $leagueId);
    }

    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where("slug", $slug);
    }
}
