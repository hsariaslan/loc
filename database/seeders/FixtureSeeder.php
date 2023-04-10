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
            $schedule = $pairFixture->getSchedule();
            $reversedSchedule = [];

            for ($j = 0; $j < 2; $j ++) {
                $i = 0;

                foreach($schedule as $week){
                    foreach($week as $games){
                        if ($j == 1) {
                            $games = array_reverse($games);
                            $reversedSchedule[$i][] = $games;
                        }
                    }

                    $i ++;
                }
            }

            $fixtureWeeks = array_merge($schedule, $reversedSchedule);
            $week = 1;

            foreach ($fixtureWeeks as $games) {
                foreach ($games as $teams) {
                    Fixture::create([
                        "league_id" => $leagueId,
                        "week" => $week,
                        "home_team_id" => $teams[0]->id,
                        "away_team_id" => $teams[1]->id,
                    ]);
                }

                $week ++;
            }
        }
    }
}
