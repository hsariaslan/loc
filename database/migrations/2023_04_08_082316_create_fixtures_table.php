<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('league_id')->constrained();
            $table->unsignedTinyInteger('week');
            $table->unsignedBigInteger('home_team_id')->nullable();
            $table->unsignedBigInteger('away_team_id')->nullable();
            $table->boolean('is_played')->default(false);
            $table->unsignedTinyInteger('home_team_score')->nullable();
            $table->unsignedTinyInteger('away_team_score')->nullable();
            $table->timestamps();

            $table->foreign('home_team_id')->on('teams')->references('id');
            $table->foreign('away_team_id')->on('teams')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
