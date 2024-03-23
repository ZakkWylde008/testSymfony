<?php

namespace App\CreateEntity;

use App\Entity\Seller;

class SellerInstance
{
    private array $data = [];

    public function __construct(array $data){
        $this->data = $data;
    }

    public function setSeller(): Seller
    {
        $seller = new Seller();

        return $seller;
    }
}