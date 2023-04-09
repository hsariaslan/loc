<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-teams', function () {
    $teams = [
        [
            "id" => 1,
            "name" => "Arsenal",
            "strength" => 90,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "id" => 2,
            "name" => "Chelsea",
            "strength" => 80,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "id" => 3,
            "name" => "Manchester City",
            "strength" => 95,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "id" => 4,
            "name" => "Liverpool",
            "strength" => 85,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "id" => 5,
            "name" => "Tottenham Hotspur",
            "strength" => 75,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
    ];

    return response()->json($teams);
});

Route::get('/generate-fixtures', function () {
    $teams = [
        [
            "id" => 1,
            "name" => "Arsenal",
            "strength" => 90,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "id" => 2,
            "name" => "Chelsea",
            "strength" => 80,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "id" => 3,
            "name" => "Manchester City",
            "strength" => 95,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "id" => 4,
            "name" => "Liverpool",
            "strength" => 85,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
//        [
//            "id" => 5,
//            "name" => "Tottenham Hotspur",
//            "strength" => 75,
//            "point" => 0,
//            "wins" => 0,
//            "loses" => 0,
//            "draws" => 0,
//            "goal_difference" => 0,
//        ],
//        [
//            "id" => 6,
//            "name" => "Manchester United",
//            "strength" => 94,
//            "point" => 0,
//            "wins" => 0,
//            "loses" => 0,
//            "draws" => 0,
//            "goal_difference" => 0,
//        ],
//        [
//            "id" => 7,
//            "name" => "Newcastle United",
//            "strength" => 74,
//            "point" => 0,
//            "wins" => 0,
//            "loses" => 0,
//            "draws" => 0,
//            "goal_difference" => 0,
//        ],
    ];

    $pairFixture = new \App\Services\FixtureService(collect($teams)->pluck("name")->toArray());
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

    $schedule = array_merge($schedule, $reversedSchedule);

    return response()->json($schedule);
});
