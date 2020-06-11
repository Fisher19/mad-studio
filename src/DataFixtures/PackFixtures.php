<?php

namespace App\DataFixtures;

use App\Entity\Pack;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PackFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        // Contenu Full Pack faké
        $pack = new Pack();

        $pack->setTitle($faker->word())
              ->setContent($faker->text(350))
              ->setImage($faker->imageUrl($width = 640, $height = 480), 'http://lorempixel.com/640/480/');

        $manager->persist($pack);    
    }
}
