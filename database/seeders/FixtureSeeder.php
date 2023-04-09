<?php

namespace Database\Seeders;

use App\Models\Fixture;
use App\Models\League;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FixtureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leagueSlug = Str::slug("Insider Champions League");
        $leagueId = League::select('id')->bySlug($leagueSlug)->first()->id;
        $teams = Team::select('id')->byLeagueId($leagueId)->inRandomOrder()->get();
        $teamsCount = $teams->count();
        $weeksCount = ($teamsCount - 1) * 2;

        for ($week = 1; $week <= $weeksCount; $week ++) {
            for ($i = $week + 1; $i <= $teamsCount; $i ++) {
                foreach ($teams as $team) {
                }
            }

            Fixture::create([
                'league_id' => $leagueId,
                'week' => $week,
                'home_team_id' => $team->id,
                'away_team_id' => $team->id,
            ]);
        }
    }
}
