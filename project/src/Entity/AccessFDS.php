<?php

namespace App\Entity;

use App\Repository\AccessFDSRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessFDSRepository::class)]
class AccessFDS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'accessFDS')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'accessFDS')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $access_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->product;
    }

    public function setProductId(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getAccessAt(): ?\DateTimeImmutable
    {
        return $this->access_at;
    }

    public function setAccessAt(?\DateTimeImmutable $access_at): static
    {
        $this->access_at = $access_at;

        return $this;
    }
}
