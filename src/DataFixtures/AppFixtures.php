<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 10; $i++) { 
            $ingredient = new Ingredient();
            $ingredient ->setIngredientName('Ingredient' . $i)
                ->set
                ->setQuantity(mt_rand(1, 10));
        
            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
