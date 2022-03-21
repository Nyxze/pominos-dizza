<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 60)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Size::class, inversedBy: 'pizza')]
    #[ORM\JoinColumn(nullable: false)]
    private $size;

    #[ORM\ManyToOne(targetEntity: Base::class, inversedBy: 'pizza')]
    #[ORM\JoinColumn(nullable: false)]
    private $base;

    #[ORM\ManyToMany(targetEntity: Topping::class, mappedBy: 'pizza', cascade: ['persist'], fetch: 'LAZY')]
    private $toppings;

    public function __construct()
    {
        $this->toppings = new ArrayCollection();
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

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getBase(): ?Base
    {
        return $this->base;
    }

    public function setBase(?Base $base): self
    {
        $this->base = $base;

        return $this;
    }

    /**
     * @return Collection<int, Topping>
     */
    public function getToppings(): Collection
    {
        return $this->toppings;
    }

    public function addTopping(Topping $topping): self
    {
        if (!$this->toppings->contains($topping)) {
            $this->toppings[] = $topping;
            $topping->addPizza($this);
        }

        return $this;
    }

    public function removeTopping(Topping $topping): self
    {
        if ($this->toppings->removeElement($topping)) {
            $topping->removePizza($this);
        }

        return $this;
    }

    public function getPrice()
    {
        $total = 0;

        foreach ($this->getToppings() as $topping){
            $total += $topping->getPrice();
        }
        return $total;
    }
}
