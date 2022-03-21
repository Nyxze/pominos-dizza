<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PizzaFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
         $pizza = new Pizza();
         $pizza->setName("Calzone")
                ->setSize($this->getReference('Medium'))
               ->setBase($this->getReference('Sauce Tomate'));

        for($i=0; $i <4; $i++){
            $topping = $this->getReference("topping". mt_rand(1, ToppingFixtures::$numberOfRecords));
            $pizza->addTopping($topping);
        }
        $manager->persist($pizza);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 10;
    }
}
