<?php

namespace App\Entity;

use App\Repository\WoodTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WoodTypeRepository::class)]
class WoodType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $origin = null;

    #[ORM\Column(length: 255)]
    private ?string $grain = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'woodType')]
    private Collection $product;

    /**
     * @var Collection<int, CustomOrder>
     */
    #[ORM\OneToMany(targetEntity: CustomOrder::class, mappedBy: 'woodType')]
    private Collection $customOrder;

    public function __construct()
    {
        $this->product = new ArrayCollection();
        $this->customOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getGrain(): ?string
    {
        return $this->grain;
    }

    public function setGrain(string $grain): static
    {
        $this->grain = $grain;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
            $product->setWoodType($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getWoodType() === $this) {
                $product->setWoodType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomOrder>
     */
    public function getCustomOrder(): Collection
    {
        return $this->customOrder;
    }

    public function addCustomOrder(CustomOrder $customOrder): static
    {
        if (!$this->customOrder->contains($customOrder)) {
            $this->customOrder->add($customOrder);
            $customOrder->setWoodType($this);
        }

        return $this;
    }

    public function removeCustomOrder(CustomOrder $customOrder): static
    {
        if ($this->customOrder->removeElement($customOrder)) {
            // set the owning side to null (unless already changed)
            if ($customOrder->getWoodType() === $this) {
                $customOrder->setWoodType(null);
            }
        }

        return $this;
    }
}
