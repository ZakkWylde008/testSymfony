<?php

namespace App\CreateEntity;

use App\Entity\Car;

class CarInstance
{
    public function setCar(array $data): Car
    {
        $car = new Car();
        $car->setBrandName($data["brandName"]);
        $car->setModel($data["model"]);
        $car->setVersion($data["version"]);
        $car->setVin($data["vin"]);
        $car->setRegistration($data["registration"]);
        $car->setMileage($data["mileage"]);
        $car->setActualOwner($data["actualOwner"]);
        $car->setEnergy($data["energy"]);
        $car->setEventOrigin($data["eventOrigin"]);
        $car->setEventAccount($data["eventAccount"]);
        $car->setLastEventAccount($data["lastEventAccount"]);
        $car->setReleaseDate($data["releaseDate"]);
        $car->setLastEventDate($data["lastEventDate"]);
        $car->setEventDate($data["eventDate"]);

        return $car;
    }
}