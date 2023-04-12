<?php

use App\Http\Controllers\FixturesController;
use App\Http\Controllers\LeagueTableController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\TeamsController;
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

Route::get('get-teams', [TeamsController::class, 'getTeams']);

Route::get('get-fixtures', [FixturesController::class, 'getFixtures']);
Route::get('generate-fixtures', [FixturesController::class, 'generateFixtures']);
Route::get('regenerate-fixtures', [FixturesController::class, 'regenerateFixtures']);
Route::get('get-matches-of-week/{week?}', [FixturesController::class, 'getMatchesOfWeek']);

Route::get('get-league-table', [LeagueTableController::class, 'getLeagueTable']);
Route::get('calculate-championship-predictions', [LeagueTableController::class, 'calculateChampionshipPredictions']);

Route::get('reset-data', [SimulationController::class, 'resetData']);
Route::get('play-matches-of-week/{week}', [SimulationController::class, 'playMatchesOfAWeek']);
Route::get('play-all-weeks', [SimulationController::class, 'playAllWeeks']);
