<?php

namespace App\CreateEntity;

use App\Entity\Customer;

class CustomerInstance
{
    private array $data = [];

    public function __construct(array $data){
        $this->data = $data;
    }

    public function setCustomer(): Customer
    {
        $customer = new Customer();

        return $customer;
    }
}