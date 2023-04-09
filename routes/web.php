<?php

use Illuminate\Support\Facades\Route;
use App\Services\FixtureService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('{all}', function () {
    return view("react");
    return view('welcome');
})->where(['all' => '.*']);

Route::get('/fixture', function () {
    //Example with a pair number of teams
    $teams = ["Arsenal", "Chelsea", "Manchester City", "Liverpool"];
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

    $schedule = array_merge($schedule, $reversedSchedule);
//    $scheduleNew = array_reverse($weeks);
//    $reversedSchedule = collect($reversedSchedule)->concat($reversedSchedule);
    dd([$schedule, $reversedSchedule]);
    dd($schedule);
    dd($schedule);


    //show the rounds
    $i = 1;
    dump($schedule);

    for ($j = 0; $j < 2; $j ++) {
        foreach($schedule as $rounds){
            echo "<h3>Round {$i}</h3>";
            foreach($rounds as $game){
                if ($j == 1) {
                    $game = array_reverse($game);
                }
                echo "{$game[0]} vs {$game[1]}<br>";
            }
            echo "<br>";
            $i++;
        }
    }
    echo "<hr>";


    //Example with an odd number of teams
    $teams[] = "Tottenham Hotspur";
    $oddFixture = new FixtureService($teams);
    $games = $oddFixture->getSchedule();
    $i = 1;

    for ($j = 0; $j < 2; $j ++) {
        foreach($games as $rounds){
            $free = "";
            echo "<h3>Round {$i}</h3>";
            foreach($rounds as $match){
                if($match[0] == "free this round"){
                    $free = "<span style='color:red;'>{$match[1]} is {$match[0]}</span><br>";
                }elseif($match[1] == "free this round"){
                    $free = "<span style='color:red;'>{$match[0]} is {$match[1]}</span><br>";
                }else{
                    if ($j == 1) {
                        $match = array_reverse($match);
                    }
                    echo "{$match[0]} vs {$match[1]}<br>";
                }
            }

            echo $free;
            echo "<br>";
            $i++;
        }
    }
});

Route::get('/league-table', function () {
    $teams = [
        [
            "name" => "Arsenal",
            "strength" => 90,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "name" => "Chelsea",
            "strength" => 80,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "name" => "Manchester City",
            "strength" => 95,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "name" => "Liverpool",
            "strength" => 85,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
    ];

    return view("league_table", compact('teams'));
});

Route::get('/react', function () {
    $teams = [
        [
            "name" => "Arsenal",
            "strength" => 90,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "name" => "Chelsea",
            "strength" => 80,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "name" => "Manchester City",
            "strength" => 95,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
        [
            "name" => "Liverpool",
            "strength" => 85,
            "point" => 0,
            "wins" => 0,
            "loses" => 0,
            "draws" => 0,
            "goal_difference" => 0,
        ],
    ];

    return view("react", compact('teams'));
});
