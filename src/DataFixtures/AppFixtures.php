<?php

namespace App\DataFixtures;

use App\Entity\Prestation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(){
        $this->faker = Factory::create('fr_FR');
    }
    
        
    
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 10; $i++) { 
            $presta = new Prestation();
            $presta -> setTitle($this->faker->word(3, true))
                    -> setLocation($this->faker->city())
                    -> setDate($this->faker->date('Y-m-d'))
                    -> setMeetingLocation($this->faker->streetAddress())
                    -> setMeetingHour($this->faker->time())
                    -> setInformation($this->faker->text(200))
                    -> setPlayingTime(mt_rand(1, 1440))
                    -> setNbPerformance(mt_rand(0, 1) == 1 ? mt_rand(1, 5):null);
                    
                    $manager -> persist($presta);
        }

        $manager->flush();
    }
}
