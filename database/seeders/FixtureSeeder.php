<?php

namespace Database\Seeders;

use App\Models\Fixture;
use App\Models\League;
use App\Models\Team;
use App\Services\FixtureService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FixtureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Fixture::exists()) {
            $leagueSlug = Str::slug("Insider Champions League");
            $leagueId = League::select('id')->bySlug($leagueSlug)->first()->id;
            $teams = Team::byLeagueId($leagueId)->get();
            $pairFixture = new FixtureService($teams);
            $fixtures = $pairFixture->getFixtures();
            $week = 1;

            foreach ($fixtures as $games) {
                foreach ($games as $teams) {
                    Fixture::create([
                        "league_id" => $leagueId,
                        "week" => $week,
                        "home_team_id" => $teams[0]->id ?? null,
                        "away_team_id" => $teams[1]->id ?? null,
                    ]);
                }

                $week ++;
            }
        }
    }
}
