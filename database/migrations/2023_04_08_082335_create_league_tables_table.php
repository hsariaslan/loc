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
        Schema::create('league_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('league_id')->constrained();
            $table->foreignId('team_id')->constrained();
            $table->unsignedTinyInteger('games')->default(0);
            $table->unsignedTinyInteger('point')->default(0);
            $table->unsignedTinyInteger('wins')->default(0);
            $table->unsignedTinyInteger('loses')->default(0);
            $table->unsignedTinyInteger('draws')->default(0);
            $table->unsignedTinyInteger('goal_difference')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('league_tables');
    }
};
