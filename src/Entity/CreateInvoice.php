<?php

namespace App\Entity;

use App\Repository\CreateInvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreateInvoiceRepository::class)]
class CreateInvoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fileNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $invoiceComment = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deliveryDate = null;

    #[ORM\ManyToOne(targetEntity: BusinessAccount::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?BusinessAccount $businessAccount;

    #[ORM\ManyToOne(targetEntity: ProspectType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProspectType $prospectType;

    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer;

    #[ORM\ManyToOne(targetEntity: Seller::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Seller $seller;

    #[ORM\ManyToOne(targetEntity: Car::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Car $car;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileNumber(): ?string
    {
        return $this->fileNumber;
    }

    public function setFileNumber(string $fileNumber): static
    {
        $this->fileNumber = $fileNumber;

        return $this;
    }

    public function getInvoiceComment(): ?string
    {
        return $this->invoiceComment;
    }

    public function setInvoiceComment(?string $invoiceComment): static
    {
        $this->invoiceComment = $invoiceComment;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeImmutable
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeImmutable $deliveryDate): static
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getSeller(): ?Seller
    {
        return $this->seller;
    }

    public function setSeller(?Seller $seller): static
    {
        $this->seller = $seller;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        $this->car = $car;

        return $this;
    }

    public function getProspectType(): ?ProspectType
    {
        return $this->prospectType;
    }

    public function setProspectType(?ProspectType $prospectType): static
    {
        $this->prospectType = $prospectType;

        return $this;
    }

    public function getBusinessAccount(): ?BusinessAccount
    {
        return $this->businessAccount;
    }

    public function setBusinessAccount(?BusinessAccount $businessAccount): static
    {
        $this->businessAccount = $businessAccount;

        return $this;
    }
}
