<?php

declare(strict_types=1);

namespace Vincent2090311\HockeyPlayoffs;

class Division
{
    /**
     * @var string
     */
    private string $divisionName;

    /**
     * @var Team[]
     */
    private array $divisionTeams;

    /**
     * @var Team
     */
    private Team $champion;

    /**
     * @var Game
     */
    private Game $game;

    /**
     * Division constructor.
     * @param string $divisionName
     */
    public function __construct(
        string $divisionName = ""
    ) {
        $this->game = new Game();
        $this->setDivisionName($divisionName);
        $this->initTeams();
    }

    /**
     * @return $this
     */
    public function initTeams() : Division
    {
        $teams = range('A', 'H');
        shuffle($teams);
        foreach ($teams as $team) {
            $this->divisionTeams[] = new Team($team);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getTeams() : array
    {
        return $this->divisionTeams;
    }

    /**
     * @return string
     */
    public function getDivisionName() : string
    {
        return $this->divisionName;
    }

    /**
     * @param string $divisionName
     */
    public function setDivisionName(string $divisionName) : Division
    {
        $this->divisionName = $divisionName;
        return $this;
    }

    /**
     * @param Team $team
     */
    public function setChampion(Team $team) : Division
    {
        $this->champion = $team;
        return $this;
    }

    /**
     * @param Team $team
     */
    public function getChampion() : Team
    {
        return $this->champion;
    }

    /**
     * @return $this
     */
    public function play() : Division
    {
        $rounds = 1;
        $teams = $this->getTeams();
        while (count($teams) != 1) {
            echo sprintf("Round # %d:\n", $rounds);
            $groups = array_chunk($teams, 2);
            $winnerTeams = [];
            foreach ($groups as $group) {
                $winner = $this->game->getWinner($group[0], $group[1]);
                $winnerTeams[] = $winner;
            }
            $rounds++;
            $teams = $winnerTeams;
        }
        $this->setChampion($teams[0]);
        return $this;
    }
}
