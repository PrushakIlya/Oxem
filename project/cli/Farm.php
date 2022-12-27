<?php

namespace Prushak;

class Farm implements FarmInterface
{
    private int $days = 7;
    protected array $productTypes = ['milkCow' => 0, 'aggs' => 0];
    protected array $productCount = ['milkCow' => 'liters', 'aggs' => 'pieces'];
    protected array $buyAnimals = [];
    protected string $nameFarm;
    protected array $initAnimals;
    protected array $registeredAnimals;

    public function __construct(string $nameFarm, array $initAnimals)
    {
        $this->initAnimals = $initAnimals;
        $this->nameFarm = $nameFarm;
        $this->givingUniqueId();
    }

    private function gatherProducts(string $animal): void
    {
        switch ($animal) {
            case 'cow' :
                $this->productTypes['milkCow'] += rand(8, 12);
                break;
            case 'chicken' :
                $this->productTypes['aggs'] += rand(0, 1);
                break;
            default:
                $this->productTypes['others'] += rand(0, 5);
        }
    }

    protected function givingUniqueId(): void
    {
        foreach ($this->initAnimals as $animal => $count) {
            for ($i = 0; $i < $count; $i++) {
                $this->registeredAnimals[$animal][] = uniqid($animal);
            }
        }
    }

    protected function getProductUnit(string $product): string
    {
        return match ($product) {

            'milkCow' => $this->productCount['milkCow'],
            'aggs' => $this->productCount['aggs'],
            default => 'kgs',
        };
    }

    public function buyAnimals(array $buyAnimals): void
    {
        $this->initAnimals = $buyAnimals;
        $this->buyAnimals = $buyAnimals;
        $this->givingUniqueId();
    }

    public function gatherProductForDay(): void
    {
        foreach ($this->registeredAnimals as $animal => $item) {
            for ($i = 0; $i < count($item); $i++) {
                $this->gatherProducts($animal);
            }
        }
    }

    public function gatherProductForDays(int $days): void
    {
        for ($i = 0; $i < $days; $i++) {
            $this->gatherProductForDay();
        }
    }

    public function getAllProducts(): string
    {
        $allProducts = 'Get all products for ' . $this->days . ' days ';

        foreach ($this->productTypes as $product => $count) {
            $allProducts .= $product . ' : ' . $count . ' ' . $this->getProductUnit($product) . ' | ';
        }

        return $allProducts;
    }

    public function show(): string
    {
        $animals = '';

        if (!empty($this->buyAnimals)) {
            $animals .= 'You have bought: ';
            foreach ($this->buyAnimals as $animal => $item) {
                $animals .= $animal . ' - ' . $item . ' things | ';
            }
        }

        $animals .= 'There are ';

        foreach ($this->registeredAnimals as $animal => $item) {
            $animals .= $animal . ' - ' . count($item) . ' things | ';
        }

        $animals .= 'in your FARM; ';


        return $animals;
    }

    public function getAnimalRegistrationNum(): string
    {
        $animalIds = 'List of ANIMALS ID: ';

        foreach ($this->registeredAnimals as $animal => $item) {
            for ($i = 0; $i < count($item); $i++) {
                $animalIds .= $i + 1 . ') ' . $animal . ' => ' . $item[$i] . ' | ';
            }
        }

        return $animalIds;
    }
}