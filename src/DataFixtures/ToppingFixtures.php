<?php

namespace App\DataFixtures;

use App\Entity\Topping;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ToppingFixtures extends Fixture implements OrderedFixtureInterface
{
    public static int $numberOfRecords;
    public static array $toppings = [
        "Poivron", "Estragon", "Frommage de chèvre", "Olives", "Boeuf",
        "Oignons", "Merguez", "Oeuf", "Saumon", "Tomates",
        "Peperoni", "Emmental", "Bacon", "Poulet",
    ];
    public function __construct()
    {
        self::$numberOfRecords = count(self::$toppings);
    }

    public function load(ObjectManager $manager): void
    {
        for($i=0; $i < self::$numberOfRecords; $i ++){

        $topping = new Topping();
        $topping->setName(self::$toppings[$i])
            ->setIsVegan(false)
            ->setIsVeggy(false)
            ->setPrice(mt_rand(1,50))
        ->setQt('1');

        $this->addReference("topping".($i+1), $topping);

        $manager->persist($topping);
        }
        $manager->flush();
    }

    public function getOrder(): int
    {
        return 5;
    }
}
