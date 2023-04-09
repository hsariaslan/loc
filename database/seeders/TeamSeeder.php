<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leagueSlug = Str::slug("Insider Champions League");
        $leagueId = League::select('id')->bySlug($leagueSlug)->first()->id;
        $teams = [
            "Arsenal",
            "Chelsea",
            "Manchester City",
            "Liverpool",
        ];

        foreach ($teams as $teamName) {
            $teamSlug = Str::slug($teamName);

            Team::updateOrCreate([
                'slug' => $teamSlug
            ], [
                'league_id' => $leagueId,
                'slug' => $teamSlug,
                'name' => $teamName,
            ]);
        }
    }
}
