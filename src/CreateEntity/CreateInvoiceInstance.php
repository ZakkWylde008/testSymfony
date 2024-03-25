<?php

namespace App\CreateEntity;

use App\Entity\CreateInvoice;

class CreateInvoiceInstance
{
    public function setCreateInvoice(array $data): CreateInvoice
    {
        $createInvoice = new CreateInvoice();
        $createInvoice->setFileNumber($data["fileNumber"]);
        $createInvoice->setInvoiceComment($data["billingComment"]);
        $createInvoice->setDeliveryDate($data["deliveryDate"]);
        $createInvoice->setBusinessAccount($data["businessAccount"]);
        $createInvoice->setProspectType($data["prospectType"]);
        $createInvoice->setCustomer($data["customer"]);
        $createInvoice->setSeller($data["seller"]);
        $createInvoice->setCar($data["car"]);

        return $createInvoice;
    }
}