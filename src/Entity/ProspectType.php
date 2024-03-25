<?php

namespace App\Entity;

use App\Repository\ProspectTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProspectTypeRepository::class)]
class ProspectType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nameProspect = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProspect(): ?string
    {
        return $this->nameProspect;
    }

    public function setNameProspect(string $nameProspect): static
    {
        $this->nameProspect = $nameProspect;

        return $this;
    }
}
