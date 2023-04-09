<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class Team extends Model
{
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
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
