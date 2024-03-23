<?php

namespace App\CreateEntity;

use App\Entity\Car;

class CarInstance
{
    private array $data = [];

    public function __construct(array $data){
        $this->data = $data;
    }

    public function setCar(): Car
    {
        $car = new Car();

        return $car;
    }
}