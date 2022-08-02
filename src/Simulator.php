<?php

declare(strict_types=1);

namespace Vincent2090311\HockeyPlayoffs;

class Simulator
{
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

        list($homeDivision, $guestDivision) = $divisions;
        $hteam = $homeDivision->getChampion();
        $gteam = $guestDivision->getChampion();
        $match = new Serie($hteam, $gteam);
        $match->processReward(true);
    }
}
