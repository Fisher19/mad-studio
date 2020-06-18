<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Service;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        // Catégories fakées
        for ($i = 1; $i <= 2; $i++) {
            $category = new Category();

            $category->setTitle($faker->word())
                    ->setDescription($faker->text(350));

            $manager->persist($category);
        }
        

        // // Services fakés
        // for ($j = 1; $j <= 8; $j++) {
        //     $service = new Service();

        //     $service->setTitle($faker->sentence())
        //             ->setContent($faker->text(200))
        //             ->setIcon($faker->imageUrl(30, 30))
        //             ->setPrice(mt_rand(90, 2000))
        //             ->setCategory($category);

        //     $manager->persist($service);
        // }
            
    }
}
