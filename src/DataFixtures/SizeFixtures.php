<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $size = new Size();
        $size->setSize('Medium')->setPrice(8);
        $this->addReference("Medium",$size);
        $manager->persist($size);

        $size = new Size();
        $size->setSize('Large')->setPrice(10);
        $this->addReference("Large",$size);
        $manager->persist($size);

        $size = new Size();
        $size->setSize('Extra Large')->setPrice(13);
        $this->addReference("Extra Large",$size);
        $manager->persist($size);

        $manager->flush();

    }
    public function getOrder(): int
    {
        return 5;
    }
}
