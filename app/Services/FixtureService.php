<?php
/**
 * Description of FixtureService (Version 1.0)
 *
 * This class implements the creation of a role play according to the number
 * of teams received to be instantiated. It can generate a schedule for any sports
 * league.
 *
 * @author: David Hernandez Jimenez <darientech@gmail.com>
 * @version: 1.0 Initial version
 *
 */

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class FixtureService
{
    /**
     * Auxiliary array
     * @var array
     */
    private array $aux = [];

    /**
     * Array to pairs rounds
     * @var array
     */
    private array $pair = [];

    /**
     * Array to odds rounds
     * @var array
     */
    private array $odd = [];

    /**
     * Counter or number of games
     * @var int
     */
    private int $countGames;

    /**
     * Counter of number of teams
     * @var int
     */
    private int $countTeams;

    /**
     * Construct
     *
     * @param Collection $teams Array with the teams names
     * @return void
     */
    public function __construct(Collection $teams)
    {
        $teams = $teams->shuffle();
        $this->countTeams = count($teams);

        if ($this->countTeams % 2 == 1) {
            $this->countTeams++;
            $teams[] = "free this round";
        }

        $this->countGames = floor($this->countTeams / 2);

        for ($i = 0; $i < $this->countTeams; $i++) {
            $this->aux[] = $teams[$i];
        }
    }

    /**
     * It makes the starting round
     * @return array Array with the matches of te round one or pair round
     */
    private function init(): array
    {
        for ($x = 0; $x < $this->countGames; $x++) {
            $this->pair[$x][0] = $this->aux[$x];
            $this->pair[$x][1] = $this->aux[($this->countTeams - 1) - $x];
        }

        return $this->pair;
    }

    /**
     * Returns the fixtures with generated schedule and merged with its reverse
     * @return array Array with the full matches created and reversed
     */
    public function getFixtures(): array
    {
        $schedule = $this->getSchedule();
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

        $fixtures = array_merge($schedule, $reversedSchedule);

        return $fixtures;
    }

    /**
     * Returns the schedule generated
     * @return array Array with the full matches created
     */
    private function getSchedule(): array
    {
        $rol = array();
        $rol[] = $this->init();

        for ($y = 1; $y < $this->countTeams - 1; $y++) {
            if ($y % 2 == 0) {
                $rol[] = $this->getPairRound();
            } else {
                $rol[] = $this->getOddRound();
            }
        }

        return $rol;
    }

    /**
     * Create the matches of a pair round
     * @return array Array with the matches created
     */
    private function getPairRound(): array
    {
        for ($z = 0; $z < $this->countGames; $z++) {
            if ($z == 0) {
                $this->pair[$z][0] = $this->odd[$z][0];
                $this->pair[$z][1] = $this->odd[$z + 1][0];
            } elseif ($z == $this->countGames - 1) {
                $this->pair[$z][0] = $this->odd[0][1];
                $this->pair[$z][1] = $this->odd[$z][1];
            } else {
                $this->pair[$z][0] = $this->odd[$z][1];
                $this->pair[$z][1] = $this->odd[$z + 1][0];
            }
        }

        return $this->pair;
    }

    /**
     * Create the matches of an odd round
     * @return array Array with the matches created
     */
    private function getOddRound(): array
    {
        for ($j = 0; $j < $this->countGames; $j++) {
            $this->odd[$j][0] = $this->pair[$j][1];

            if ($j == 0) {
                $this->odd[$j][1] = $this->pair[$this->countGames - 1][0]; //Pivot
            } else {
                $this->odd[$j][1] = $this->pair[$j - 1][0];
            }
        }

        return $this->odd;
    }
}
