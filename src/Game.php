<?php

declare(strict_types=1);

namespace Vincent2090311\HockeyPlayoffs;

class Game
{
    const MATCHES = 7;
    const WINNING_SCORE = 4;

    /**
     * @param Team $home
     * @param Team $visitor
     * @return Team
     */
    public function getWinner(Team $home, Team $visitor) : Team
    {
        $scores = [
            $home->getName() => 0,
            $visitor->getName() => 0
        ];
        for ($i = 0; $i <= self::MATCHES; $i++) {
            $homeWinRate = $home->getSuccessRates() * rand(0, 100);
            $visitorWinRate = $visitor->getSuccessRates() * rand(0, 100);

            $winner = $homeWinRate > $visitorWinRate ? $home : $visitor;
            $scores[$winner->getName()]++;
            if ($scores[$winner->getName()] == self::WINNING_SCORE) {
                $loser = ($winner->getName() == $home->getName()) ? $visitor : $home;
                echo sprintf(
                    "Serie %s vs %s - Winner: %s (%d/%d)\n",
                    $home->getName(),
                    $visitor->getName(),
                    $winner->getName(),
                    $scores[$winner->getName()],
                    $scores[$loser->getName()]
                );
                return $winner;
            }
        }
    }

    /**
     * @param Division $divisionA
     * @param Division $divisionB
     * @return Team
     */
    public function getChampion(Division $divisionA, Division $divisionB) : Team
    {
        $home = $divisionA->getChampion();
        $visitor = $divisionB->getChampion();
        $scores = [
            $home->getName() => 0,
            $visitor->getName() => 0
        ];
        for ($i = 0; $i <= self::MATCHES; $i++) {
            $homeWinRate = $home->getSuccessRates() + rand(0, 100) / 100;
            $visitorWinRate = $visitor->getSuccessRates() + rand(0, 100) / 100;

            $winner = $homeWinRate > $visitorWinRate ? $home : $visitor;
            $winnerDivision = $homeWinRate > $visitorWinRate ? $divisionA : $divisionB;
            $scores[$winner->getName()]++;
            if ($scores[$winner->getName()] == self::WINNING_SCORE) {
                $loser = ($winner->getName() == $home->getName()) ? $visitor : $home;
                echo sprintf(
                    "Final %s %s vs %s %s - Winner: %s %s (%d/%d)\n",
                    $divisionA->getDivisionName(),
                    $home->getName(),
                    $divisionB->getDivisionName(),
                    $visitor->getName(),
                    $winnerDivision->getDivisionName(),
                    $winner->getName(),
                    $scores[$winner->getName()],
                    $scores[$loser->getName()]
                );
                return $winner;
            }
        }
    }
}
