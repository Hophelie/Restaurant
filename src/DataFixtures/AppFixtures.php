<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Restaurant;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($faker));
         
            for($i = 1 ; $i <=20 ; $i++){

                $value = 'user'.$i;

                $user = new User();
                $password = $this->encoder->encodePassword($user, $value);
                $user->setEmail($faker->email())
                ->setPassword($password)  
                ->setPrenom($faker->firstName())
                ->setRoles(["ROLE_RESTAURATEUR", "ROLE_USER"])
                ->setNom($faker->lastName());
                         
                $manager->persist($user);


                $restaurant = new Restaurant();
                $restaurant->setNom($faker->company())
                ->setAdresse($faker->address())
                ->setTel($faker->phoneNumber());
                
                $manager->persist($restaurant);

                for($j = 1 ; $j <=10 ; $j++){

                    $produit = new Produit();
                    $produit->setDescription($faker->text($maxNbChars = 100) )
                    ->setNom($faker->foodName())
                    ->setPrix($faker->randomDigitNot(20))
                    ->setRestaurant($restaurant);
                    $manager->persist($produit);
                
                }


                $manager->flush();
 
            } 
        }

}
