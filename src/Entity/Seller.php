<?php

namespace App\Entity;

use App\Repository\SellerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SellerRepository::class)]
class Seller
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $folderNumberVNVO = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $salesIntermediaryVN = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getVn(): ?string
    {
        return $this->vn;
    }

    public function setVn(?string $vn): static
    {
        $this->vn = $vn;

        return $this;
    }

    public function getVo(): ?string
    {
        return $this->vo;
    }

    public function setVo(?string $vo): static
    {
        $this->vo = $vo;

        return $this;
    }

    public function getFolderNumberVNVO(): ?string
    {
        return $this->folderNumberVNVO;
    }

    public function setFolderNumberVNVO(?string $folderNumberVNVO): static
    {
        $this->folderNumberVNVO = $folderNumberVNVO;

        return $this;
    }

    public function getSalesIntermediaryVN(): ?string
    {
        return $this->salesIntermediaryVN;
    }

    public function setSalesIntermediaryVN(?string $salesIntermediaryVN): static
    {
        $this->salesIntermediaryVN = $salesIntermediaryVN;

        return $this;
    }
}
