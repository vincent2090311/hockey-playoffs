<?php

declare(strict_types=1);

namespace Vincent2090311\HockeyPlayoffs;

class Team
{
    const TOTAL_PLAYERS = 21;

    /**
     * @var string
     */
    private string $teamName;

    /**
     * @var float
     */
    private float $successRate;

    /**
     * @var Team
     */
    private Division $division;

    /**
     * Team constructor.
     * @param string $teamName
     */
    public function __construct(
        string $teamName = ''
    ) {
        $this->setName($teamName);
        $this->initTeamSuccessRate();
    }

    /**
     * @return $this
     */
    public function initTeamSuccessRate() : Team
    {
        $playerRate = [];
        for ($i = 0; $i < self::TOTAL_PLAYERS; $i++) {
            // Avoid Deprecated: Implicit conversion from float 0.15 to int loses precision
            $playerRate[] = rand(15, 100) / 100;
        }
        $rate = array_sum($playerRate) / self::TOTAL_PLAYERS;
        $this->setSuccessRates($rate);

        return $this;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->teamName;
    }

    /**
     * @param string $teamName
     * @return $this
     */
    public function setName(string $teamName) : Team
    {
        $this->teamName = $teamName;
        return $this;
    }

    /**
     * @return float
     */
    public function getSuccessRates() : float
    {
        return $this->successRate;
    }

    /**
     * @param float $rate
     * @return $this
     */
    public function setSuccessRates(float $rate) : Team
    {
        $this->successRate = $rate;
        return $this;
    }

    /**
     * @return Division
     */
    public function getDivision() : Division
    {
        return $this->division;
    }

    /**
     * @param Division $division
     * @return $this
     */
    public function setDivision(Division $division) : Team
    {
        $this->division = $division;
        return $this;
    }
}
