<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\LeagueTable;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LeagueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leagueSlug = Str::slug("Insider Champions League");
        $leagueId = League::select('id')->bySlug($leagueSlug)->first()->id;
        $teams = Team::byLeagueId($leagueId)->get();

        foreach ($teams as $team) {
            LeagueTable::updateOrCreate([
                "league_id" => $leagueId,
                "team_id" => $team->id,
            ], [
                "league_id" => $leagueId,
                "team_id" => $team->id,
            ]);
        }
    }
}
