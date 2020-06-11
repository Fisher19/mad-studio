<?php

namespace App\DataFixtures;

use App\Entity\Argument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArgumentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        // Catégories fakées
        for ($i = 1; $i <= 4; $i++) {
            $argument = new Argument();

            $argument->setTitle($faker->word())
                    ->setContent($faker->text(200))
                    ->setIcon($faker->imageUrl($width = 30, $height = 30), 'http://lorempixel.com/30/30/');

            $manager->persist($argument);
        }
    }
}
