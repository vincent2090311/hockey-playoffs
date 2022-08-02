<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

use Vincent2090311\HockeyPlayoffs\Simulator;

$simulator = new Simulator();
$simulator->execute();
