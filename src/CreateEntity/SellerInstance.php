<?php

namespace App\CreateEntity;

use App\Entity\Seller;

class SellerInstance
{
    public function setSeller(array $data): Seller
    {
        $seller = new Seller();
        $seller->setType($data["typeVNVO"]);
        $seller->setVn($data["sellerVN"]);
        $seller->setVo($data["sellerVO"]);
        $seller->setFolderNumberVNVO($data["folderNumberVNVO"]);
        $seller->setSalesIntermediaryVN($data["salesIntermediaryVN"]);

        return $seller;
    }
}