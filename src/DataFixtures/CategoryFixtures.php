<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Category = new Category();
        $Category->setName('Basique');

        $Category2 = new Category();
        $Category2->setName('Avancé');

         $manager->persist($Category);
         $manager->persist($Category2);

        $manager->flush();
    }
}
