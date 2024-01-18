<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Entity\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $product_name = null;

    #[ORM\ManyToOne(inversedBy: 'description')]
    private ?File $file = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: AccessFDS::class)]
    private Collection $accessFDS;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    public function __construct()
    {
        $this->accessFDS = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): static
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, AccessFDS>
     */
    public function getAccessFDS(): Collection
    {
        return $this->accessFDS;
    }

    public function addAccessFD(AccessFDS $accessFD): static
    {
        if (!$this->accessFDS->contains($accessFD)) {
            $this->accessFDS->add($accessFD);
            $accessFD->setProductId($this);
        }

        return $this;
    }

    public function removeAccessFD(AccessFDS $accessFD): static
    {
        if ($this->accessFDS->removeElement($accessFD)) {
            // set the owning side to null (unless already changed)
            if ($accessFD->getProductId() === $this) {
                $accessFD->setProductId(null);
            }
        }

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
