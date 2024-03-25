<?php

namespace App\CreateEntity;

use App\Entity\Customer;

class CustomerInstance
{
    public function setCustomer(array $data): Customer
    {
        $customer = new Customer();
        $customer->setCivilCode($data["civilCode"]);
        $customer->setName($data["name"]);
        $customer->setFirstname($data["firstname"]);
        $customer->setStreet($data["street"]);
        $customer->setAdressComplement($data["adressComplement"]);
        $customer->setPostalCode($data["postalCode"]);
        $customer->setCity($data["city"]);
        $customer->setHomePhone($data["homePhone"]);
        $customer->setMobilePhone($data["mobilePhone"]);
        $customer->setJobPhone($data["jobPhone"]);
        $customer->setEmail($data["email"]);

        return $customer;
    }
}