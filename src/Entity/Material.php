<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'material')]
    private Collection $product;

    /**
     * @var Collection<int, CustomOrder>
     */
    #[ORM\OneToMany(targetEntity: CustomOrder::class, mappedBy: 'material')]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
            $product->setMaterial($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getMaterial() === $this) {
                $product->setMaterial(null);
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
            $customOrder->setMaterial($this);
        }

        return $this;
    }

    public function removeCustomOrder(CustomOrder $customOrder): static
    {
        if ($this->customOrder->removeElement($customOrder)) {
            // set the owning side to null (unless already changed)
            if ($customOrder->getMaterial() === $this) {
                $customOrder->setMaterial(null);
            }
        }

        return $this;
    }
}
