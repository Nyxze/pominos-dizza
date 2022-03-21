<?php

namespace App\Entity;

use App\Repository\ToppingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToppingRepository::class)]
class Topping
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 128)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\ManyToMany(targetEntity: Pizza::class, inversedBy: 'toppings')]
    private $pizza;

    #[ORM\Column(type: 'boolean')]
    private $isVegan;

    #[ORM\Column(type: 'boolean')]
    private $isVeggy;

    #[ORM\Column(type: 'integer')]
    private $qt;

    public function __construct()
    {
        $this->pizza = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizza(): Collection
    {
        return $this->pizza;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizza->contains($pizza)) {
            $this->pizza[] = $pizza;
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        $this->pizza->removeElement($pizza);

        return $this;
    }

    public function getIsVegan(): ?bool
    {
        return $this->isVegan;
    }

    public function setIsVegan(bool $isVegan): self
    {
        $this->isVegan = $isVegan;

        return $this;
    }

    public function getIsVeggy(): ?bool
    {
        return $this->isVeggy;
    }

    public function setIsVeggy(bool $isVeggy): self
    {
        $this->isVeggy = $isVeggy;

        return $this;
    }

    public function getQt(): ?int
    {
        return $this->qt;
    }

    public function setQt(int $qt): self
    {
        $this->qt = $qt;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
