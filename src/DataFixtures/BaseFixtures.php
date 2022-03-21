<?php

namespace App\DataFixtures;

use App\Entity\Base;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BaseFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $base = new Base();
        $base->setName('Crème');
        $this->addReference("Crème",$base);
        $manager->persist($base);


        $base = new Base();
        $base->setName('Sauce Tomate');
        $this->addReference("Sauce Tomate",$base);
        $manager->persist($base);

        $manager->flush();
    }
    public function getOrder(): int
    {
        return 5;
    }

}
