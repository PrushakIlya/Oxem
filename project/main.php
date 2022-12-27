<?php

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Prushak\BelarusianFarm;

$initAnimals = array(
    'cow' => 1,
    'chicken' => 1
);

$farm = new BelarusianFarm('RevolutionQuality', $initAnimals);
echo $farm->show();
$farm->gatherProductForDays(7);
echo $farm->getAllProducts();

$buyAnimals = array(
    'cow' => 5,
    'chicken' => 5
);

$farm->buyAnimals($buyAnimals);
echo $farm->show();

echo $farm->getAnimalRegistrationNum();