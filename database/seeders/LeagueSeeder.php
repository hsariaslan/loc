<?php

namespace Database\Seeders;

use App\Models\League;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leagueName = "Insider Champions League";

        League::updateOrCreate([
            'slug' => Str::slug($leagueName)
        ], [
            'slug' => Str::slug($leagueName),
            'name' => $leagueName,
        ]);
    }
}
