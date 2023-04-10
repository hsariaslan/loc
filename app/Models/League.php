<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where("slug", $slug);
    }
}
