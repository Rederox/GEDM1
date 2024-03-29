<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Entity\Fds;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[Vich\Uploadable]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $product_name = null;

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'fdsName')]
    private ?File $fdsFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $fdsName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: AccessFDS::class)]
    private Collection $accessFDS;



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

/**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $fdsFile
     */
    public function setfdsFile(?File $fdsFile = null): void
    {
        $this->fdsFile = $fdsFile;

        if (null !== $fdsFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getfdsFile(): ?File
    {
        return $this->fdsFile;
    }

    public function setfdsName(?string $fdsName): void
    {
        $this->fdsName = $fdsName;
    }

    public function getfdsName(): ?string
    {
        return $this->fdsName;
    }

    

}