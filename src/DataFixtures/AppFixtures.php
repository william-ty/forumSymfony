<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Topic;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    //     $author = $manager->getRepository(User::class)->findOneBy(["pseudo" => "admin"]);


    //     for($i = 1; $i < 10; $i++){​​

    //         $topic = new Topic();

    //         $topic->setTitle("Le sujet n°".$i);

    //         $topic->setAuthor($author);



    //         $manager->persist($topic);

    //     }​​

    //     $manager->flush();

    // ​​
        // $generator = Faker\Factory::create("fr_FR");
        // for ($i=0; $i < 20; $i++) { 
        //     $user = new User();
        //     $user
        //         ->setEmail($generator->email)
        //         ->setRoles([])
        //         ->setPassword('password')
        //         ->setPseudo('pseudo'.$i)
        //         ->setDateCreated(new \DateTime());
        //         // ->setDateBanned('');
        //         $manager->persist($user);
        // }
        // $manager->flush();


    }


}

// public function load(ObjectManager $manager)

// {​​

//     $author = $manager->getRepository(User::class)->findOneBy(["pseudo" => "admin"]);

    

//     for($i = 1; $i < 10; $i++){​​

//         $topic = new Topic();

//         $topic->setTitle("Le sujet n°".$i);

//         $topic->setAuthor($author);



//         $manager->persist($topic);

//     }​​

//     $manager->flush();

// }​​

// }​​
