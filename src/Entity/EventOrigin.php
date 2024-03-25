<?php

namespace App\Entity;

use App\Repository\EventOriginRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventOriginRepository::class)]
class EventOrigin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $eventOrigin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventOrigin(): ?string
    {
        return $this->eventOrigin;
    }

    public function setEventOrigin(string $eventOrigin): static
    {
        $this->eventOrigin = $eventOrigin;

        return $this;
    }
}
