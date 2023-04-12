<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\LeagueTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class LeagueTableController extends Controller
{
    public function getLeagueTable(): JsonResponse
    {
        $leagueTable = LeagueTable::with(['team'])->orderBy('point', 'desc')->orderBy('goal_difference', 'desc')->get();

        return response()->json($leagueTable);
    }

    public function calculateChampionshipPredictions(): JsonResponse
    {
        $leagueSlug = Str::slug("Insider Champions League");
        $league = League::with('leagueTable.team')->bySlug($leagueSlug)->first();

        return response()->json($league->leagueTable);
    }
}
