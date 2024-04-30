<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Prestation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(){
        $this->faker = Factory::create('fr_FR');
    }
    
        
    
    public function load(ObjectManager $manager): void
    {
        //Users
        $users = [];   
        for ($i=0; $i < 10; $i++) { 
            $car = 0;
            $user = new User();
            $user   -> setName($this->faker->lastName())
                    -> setFirstName($this->faker->firstName())
                    -> setPseudo(mt_rand(0, 1) === 1 ? $this->faker->word() : null)                     
                    -> setEmail($this->faker->email())
                    -> setRoles(['ROLE_USER'])
                    -> setPlainPassword('password')
                    -> setBirthday(new \DateTimeImmutable($this->faker->date('Y-m-d')))
                    -> setAddress($this->faker->streetAddress())
                    -> setPhone($this->faker->phoneNumber())
                    -> setCar(mt_rand(0, 1) == 1 ? true : false)
                    -> setCarSeat($car == true ? mt_rand(0, 6) : null);
            
            $users[] = $user;
            $manager -> persist($user);
        }

        //Prestation
        $prestations = [];
        for ($i=0; $i < 10; $i++) { 
            $presta = new Prestation();
            $presta -> setTitle($this->faker->word(3, true))
                    -> setLocation($this->faker->city())
                    -> setDate(new \DateTimeImmutable($this->faker->date('Y-m-d')))
                    -> setMeetingLocation($this->faker->streetAddress())
                    -> setMeetingHour(new \DateTimeImmutable($this->faker->time('H:i')))
                    -> setInformation($this->faker->text(200))
                    -> setPlayingTime(new \DateTimeImmutable($this->faker->time('H:i')))
                    -> setNbPerformance(mt_rand(0, 1) == 1 ? mt_rand(1, 5):null);

                    $prestations[] = $presta;
                    $manager -> persist($presta);
        }

        $manager->flush();
    }
}
