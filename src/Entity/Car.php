<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $brandName = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $model = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $version = null;

    #[ORM\Column(length: 50)]
    private ?string $vin = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $registration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mileage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $actualOwner = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $energy = null;

    #[ORM\ManyToOne(targetEntity: EventOrigin::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?EventOrigin $eventOrigin;

    #[ORM\ManyToOne(targetEntity: EventAccount::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?EventAccount $eventAccount;

    #[ORM\ManyToOne(targetEntity: EventAccount::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?EventAccount $lastEventAccount = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $releaseDate = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $lastEventDate = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $eventDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function setBrandName(string $brandName): static
    {
        $this->brandName = $brandName;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): static
    {
        $this->vin = $vin;

        return $this;
    }

    public function getRegistration(): ?string
    {
        return $this->registration;
    }

    public function setRegistration(?string $registration): static
    {
        $this->registration = $registration;

        return $this;
    }

    public function getMileage(): ?string
    {
        return $this->mileage;
    }

    public function setMileage(?string $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getActualOwner(): ?string
    {
        return $this->actualOwner;
    }

    public function setActualOwner(?string $actualOwner): static
    {
        $this->actualOwner = $actualOwner;

        return $this;
    }

    public function getEnergy(): ?string
    {
        return $this->energy;
    }

    public function setEnergy(?string $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeImmutable $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getLastEventDate(): ?\DateTimeImmutable
    {
        return $this->lastEventDate;
    }

    public function setLastEventDate(?\DateTimeImmutable $lastEventDate): static
    {
        $this->lastEventDate = $lastEventDate;

        return $this;
    }

    public function getEventDate(): ?\DateTimeImmutable
    {
        return $this->eventDate;
    }

    public function setEventDate(?\DateTimeImmutable $eventDate): static
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getEventOrigin(): ?EventOrigin
    {
        return $this->eventOrigin;
    }

    public function setEventOrigin(?EventOrigin $eventOrigin): static
    {
        $this->eventOrigin = $eventOrigin;

        return $this;
    }

    public function getEventAccount(): ?EventAccount
    {
        return $this->eventAccount;
    }

    public function setEventAccount(?EventAccount $eventAccount): static
    {
        $this->eventAccount = $eventAccount;

        return $this;
    }

    public function getLastEventAccount(): ?EventAccount
    {
        return $this->lastEventAccount;
    }

    public function setLastEventAccount(?EventAccount $lastEventAccount): static
    {
        $this->lastEventAccount = $lastEventAccount;

        return $this;
    }
}
