<?php

declare(strict_types=1);

namespace Vincent2090311\HockeyPlayoffs;

class Simulator
{
    /**
     * @var Game
     */
    private Game $game;

    /**
     * Simulator constructor.
     */
    public function __construct()
    {
        $this->game = new Game();
    }

    /**
     * @return void
     */
    public function execute() : void
    {
        $league = new League();
        $divisions = $league->getDivisions();

        foreach ($divisions as $division) {
            echo sprintf("%s Division: \n", $division->getDivisionName());
            $division->play();
            echo "----------------------\n";
        }

        list($divisionA, $divisionB) = $divisions;
        $this->game->getChampion($divisionA, $divisionB);
    }
}
