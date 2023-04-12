<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\LeagueTable;
use App\Services\SimulationService;
use Database\Seeders\FixtureSeeder;
use Illuminate\Http\JsonResponse;

class SimulationController extends Controller
{
    public function playAllWeeks(): JsonResponse
    {
        $weeksCount = Fixture::orderBy('week', 'desc')->first()->week;
        $gamesCount = LeagueTable::orderBy('games', 'desc')->first()->games;
        $results = null;

        if ($gamesCount + 2 < $weeksCount) {
            for ($week = 1; $week <= $weeksCount; $week++) {
                $results = $this->playMatchesOfTheWeek($week);
            }
        }

        return response()->json(Fixture::all()->groupBy('week')->values());
    }

    public function playMatchesOfAWeek(int $week): JsonResponse
    {
        $results = $this->playMatchesOfTheWeek($week);

        return response()->json($results);
    }

    private function playMatchesOfTheWeek(int $week): array
    {
        $fixtures = Fixture::byWeek($week)->get();
        $leagueTable = LeagueTable::with('team')->get();

        foreach ($fixtures as $fixture) {
            $homeTeam = $fixture->homeTeam;
            $awayTeam = $fixture->awayTeam;

            if (!empty($homeTeam) && !empty($awayTeam)) {
                $homeTeamGamesCount = LeagueTable::select('games')->byTeamId($homeTeam->id)->first()->games;
                $awayTeamGamesCount = LeagueTable::select('games')->byTeamId($awayTeam->id)->first()->games;

                if ($fixture->week > $homeTeamGamesCount && $fixture->week > $awayTeamGamesCount) {
                    $simulation = new SimulationService($homeTeam, $awayTeam);
                    $fixture->home_team_score = $simulation->getHomeTeamScore();
                    $fixture->away_team_score = $simulation->getAwayTeamScore();
                    $fixture->save();

                    $homeTeamLeagueTable = LeagueTable::byTeamId($homeTeam->id)->first();
                    $awayTeamLeagueTable = LeagueTable::byTeamId($awayTeam->id)->first();

                    $homeTeamLeagueTable->games += 1;
                    $awayTeamLeagueTable->games += 1;

                    if ($fixture->home_team_score > $fixture->away_team_score) {
                        $homeTeamLeagueTable->point += 3;
                        $homeTeamLeagueTable->wins += 1;
                        $homeTeamLeagueTable->goal_difference += ($fixture->home_team_score - $fixture->away_team_score);

                        $awayTeamLeagueTable->loses += 1;
                        $awayTeamLeagueTable->goal_difference -= ($fixture->home_team_score - $fixture->away_team_score);
                    } else if ($fixture->away_team_score > $fixture->home_team_score) {
                        $awayTeamLeagueTable->point += 3;
                        $awayTeamLeagueTable->wins += 1;
                        $awayTeamLeagueTable->goal_difference += ($fixture->away_team_score - $fixture->home_team_score);

                        $homeTeamLeagueTable->loses += 1;
                        $homeTeamLeagueTable->goal_difference -= ($fixture->away_team_score - $fixture->home_team_score);
                    } else {
                        $homeTeamLeagueTable->point += 1;
                        $homeTeamLeagueTable->draws += 1;

                        $awayTeamLeagueTable->point += 1;
                        $awayTeamLeagueTable->draws += 1;
                    }

                    $homeTeamLeagueTable->save();
                    $awayTeamLeagueTable->save();
                }
            }
        }

        return [
            "fixtures" => $fixtures,
            "leagueTable" => $leagueTable,
        ];
    }

    public function resetData(): JsonResponse
    {
        Fixture::truncate();
        LeagueTable::truncate();

        $fixtureSeeder = new FixtureSeeder();
        $fixtureSeeder->run();

        $leagueTableSeeder = new \Database\Seeders\LeagueTableSeeder();
        $leagueTableSeeder->run();

        $data = [
            "leagueTable" => LeagueTable::with('team')->get(),
            "fixtures" => Fixture::all(),
        ];

        return response()->json($data);
    }
}
