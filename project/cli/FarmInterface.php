<?php

namespace Prushak;
interface FarmInterface
{
    public function buyAnimals(array $buyAnimals): void;

    public function gatherProductForDay(): void;

    public function gatherProductForDays(int $days): void;
}