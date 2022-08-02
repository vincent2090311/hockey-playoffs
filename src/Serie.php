<?php

declare(strict_types=1);

namespace Vincent2090311\HockeyPlayoffs;

class Serie
{
    const MATCHES = 7;
    const WINNING_SCORE = 4;

    /**
     * @var Team
     */
    private Team $home;

    /**
     * @var Team
     */
    private Team $guest;

    /**
     * @var Team
     */
    private Team $winner;

    /**
     * @var Team
     */
    private Team $loser;

    /**
     * @var int
     */
    private array $matchScore;

    /**
     * @param Team $home
     * @param Team $guest
     */
    public function __construct(
        Team $home,
        Team $guest
    ) {
        $this->home = $home;
        $this->guest = $guest;
        $this->playGame();
    }

    /**
     * @param Team $home
     * @param Team $guest
     * @return Team
     */
    private function playGame() : Team
    {
        $scores = [
            $this->home->getName() => 0,
            $this->guest->getName() => 0
        ];
        for ($i = 0; $i <= self::MATCHES; $i++) {
            $homeWinRate = $this->home->getSuccessRates() * rand(0, 100) / 100;
            $guestWinRate = $this->guest->getSuccessRates() * rand(0, 100) / 100;

            $winner = $homeWinRate > $guestWinRate ? $this->home : $this->guest;
            $scores[$winner->getName()]++;
            if ($scores[$winner->getName()] == self::WINNING_SCORE) {
                $loser = ($winner->getName() == $this->home->getName()) ? $this->guest : $this->home;

                $this->setWinner($winner);
                $this->setLoser($loser);
                $this->setScores($scores);
                return $winner;
            }
        }
    }

    /**
     * @return Team
     */
    public function getWinner() : Team
    {
        return $this->winner;
    }

    /**
     * @return $this
     */
    public function setWinner(Team $winner) : Serie
    {
        $this->winner = $winner;
        return $this;
    }

    /**
     * @return Team
     */
    public function getLoser() : Team
    {
        return $this->loser;
    }

    /**
     * @return $this
     */
    public function setLoser(Team $loser) : Serie
    {
        $this->loser = $loser;
        return $this;
    }

    /**
     * @return array
     */
    public function getScores() : array
    {
        return $this->matchScore;
    }

    /**
     * @return $this
     */
    public function setScores(array $score) : Serie
    {
        $this->matchScore = $score;
        return $this;
    }

    /**
     * @return $this
     */
    public function processReward($isFinal = false) : Serie
    {
        if ($isFinal) {
            $scores = $this->getScores();
            $winner = $this->getWinner();
            $loser = $this->getLoser();
            $homeDivision = $this->home->getDivision();
            $guestDivision = $this->guest->getDivision();
            $winnerDivision = $winner->getDivision();
            echo sprintf(
                "Final %s %s vs %s %s - Winner: %s %s (%d/%d)\n",
                $homeDivision->getDivisionName(),
                $this->home->getName(),
                $guestDivision->getDivisionName(),
                $this->guest->getName(),
                $winnerDivision->getDivisionName(),
                $winner->getName(),
                $scores[$winner->getName()],
                $scores[$loser->getName()]
            );
        } else {
            $scores = $this->getScores();
            $winner = $this->getWinner();
            $loser = $this->getLoser();
            echo sprintf(
                "Serie %s vs %s - Winner: %s (%d/%d)\n",
                $this->home->getName(),
                $this->guest->getName(),
                $winner->getName(),
                $scores[$winner->getName()],
                $scores[$loser->getName()]
            );
        }
        return $this;
    }
}
