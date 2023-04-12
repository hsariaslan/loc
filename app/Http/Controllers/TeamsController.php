<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;

class TeamsController extends Controller
{
    public function getTeams(): JsonResponse
    {
        $teams = Team::all();

        return response()->json($teams);
    }
}
