<?php

declare(strict_types=1);

namespace Vincent2090311\HockeyPlayoffs;

class League
{
    const DIVISIONS = ["East", "West"];

    /**
     * @var Division[]
     */
    private array $divisions;

    /**
     * League constructor
     */
    public function __construct()
    {
        $this->initDivisions();
    }

    /**
     * @return $this
     */
    public function initDivisions() : League
    {
        foreach (self::DIVISIONS as $division) {
            $this->divisions[] = new Division($division);
        }
        return $this;
    }

    /**
     * @return Division[]
     */
    public function getDivisions() : array
    {
        return $this->divisions;
    }
}
