<?php

namespace App\Services;

use App\Models\Team;
use MathPHP\Probability\Distribution\Discrete\Poisson;

class SimulationService
{
    private Team $homeTeam;
    private Team $awayTeam;
    private int $homeTeamScore;
    private int $awayTeamScore;
    private float $maximumPossibleGoals = 6;
    private float $minimumAverageGoal = 0.2;
    private float $strengthPowerMultiplier = 0.7;
    private float $percentOfStrength = 0.4;
    private float $fixedSubtract = 4;

    /**
     * @param Team $homeTeam
     * @param Team $awayTeam
     */
    public function __construct(Team $homeTeam, Team $awayTeam)
    {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $homeTeamAverageGoal = $this->calculateAverageGoalsOfTeam($this->homeTeam);
        $awayTeamAverageGoal = $this->calculateAverageGoalsOfTeam($this->awayTeam);
        $homeTeamGoalProbabilities = $this->calculateGoalProbabilitiesOfTeam($homeTeamAverageGoal);
        $awayTeamGoalProbabilities = $this->calculateGoalProbabilitiesOfTeam($awayTeamAverageGoal);
        $this->homeTeamScore = $this->calculateScore($homeTeamGoalProbabilities);
        $this->awayTeamScore = $this->calculateScore($awayTeamGoalProbabilities);
    }

    public function getHomeTeamScore(): int
    {
        return $this->homeTeamScore;
    }

    public function getAwayTeamScore(): int
    {
        return $this->awayTeamScore;
    }

    private function calculateAverageGoalsOfTeam(Team $team): float
    {
        return max($this->minimumAverageGoal, (
            pow($team->strength / 10, $this->strengthPowerMultiplier) *
            (1 + $this->percentOfStrength * $team->strength / 100) - $this->fixedSubtract
        ));
    }

    private function calculateGoalProbabilitiesOfTeam(float $averageGoal): array
    {
        $averageGoalPoission = new Poisson($averageGoal);
        $goalProbabilities = [];

        for($goals = 0; $goals < $this->maximumPossibleGoals; $goals ++) {
            $goalProbabilities[] = $averageGoalPoission->pmf($goals) * 100;

            if($goals > 0) {
                $goalProbabilities[$goals] += $goalProbabilities[$goals - 1];
            }
        }

        return $goalProbabilities;
    }

    private function calculateScore(array $goalProbabilities): int
    {
        $probability = rand(0, 100);
        $score = 0;

        foreach ($goalProbabilities as $goalProbability) {
            if($goalProbability <= $probability) {
                $score ++;
            } else {
                break;
            }
        }

        return $score;
    }
}
