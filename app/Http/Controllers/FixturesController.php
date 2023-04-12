<?php

namespace App\Http\Controllers;

use App\Http\Resources\FixtureCollection;
use App\Models\Fixture;
use Database\Seeders\FixtureSeeder;
use Illuminate\Http\JsonResponse;

class FixturesController extends Controller
{
    public function getFixtures(): JsonResponse
    {
        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])->get();

        return response()->json($fixtures->groupBy('week')->values());
    }

    public function generateFixtures(): JsonResponse
    {
        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])->get();

        if ($fixtures->isEmpty()) {
            $seeder = new FixtureSeeder();
            $seeder->run();
            $fixtures = Fixture::with(['homeTeam', 'awayTeam'])->get();
        }

        $fixtures = new FixtureCollection($fixtures);
        $fixtures = $fixtures->collection;

        return response()->json($fixtures->groupBy('week')->values());
    }

    public function regenerateFixtures(): JsonResponse
    {
        Fixture::truncate();
        $seeder = new FixtureSeeder();
        $seeder->run();
        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])->get();
        $fixtures = new FixtureCollection($fixtures);
        $fixtures = $fixtures->collection;

        return response()->json($fixtures->groupBy('week')->values());
    }

    public function getMatchesOfWeek(int $week = null): JsonResponse
    {
        $nextWeek = is_null($week) ? Fixture::select('week')->byNotPlayedYet()->first()->week : $week;
        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])->byWeek($nextWeek)->get();

        return response()->json($fixtures);
    }
}
