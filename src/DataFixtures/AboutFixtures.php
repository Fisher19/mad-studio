<?php

namespace App\DataFixtures;

use App\Entity\About;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AboutFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        // Contenu à propos faké
        $about = new About();

        $about->setTitle($faker->word())
              ->setPresentation($faker->text(350))
              ->setImage($faker->imageUrl($width = 640, $height = 480), 'http://lorempixel.com/640/480/');

        $manager->persist($about);
    }
    
}
