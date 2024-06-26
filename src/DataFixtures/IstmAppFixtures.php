<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Event;
use App\Entity\Filiere;
use App\Entity\Profile;
use App\Entity\StudentBook;
use App\Entity\User;
use EsperoSoft\Faker\Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IstmAppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = new Faker();
        $profile = new Profile();
        $users = [];
        for ($i=0; $i < 2; $i++) { 
            $user = (new User())->setFullName($faker->full_name())
                                ->setEmail($faker->email())
                                ->setPassword(sha1("olivier"))
                                ->setFonction($faker->country());
            $profile = (new Profile())->setPicture($faker->image())
                                    ->setDescription($faker->description(60))
                                    ->setCreatedAt($faker->dateTimeImmutable());
            $users[] = $user;
            $profile->setUser($user); 
            $manager->persist($profile);
            $manager->persist($user);
        }

        $articles = [];
        for ($i=0; $i < 10; $i++) {
            $article = (new Article())->setTitle($faker->title())
                                    ->setContent($faker->text(10, 60))
                                    ->setImageUrl($faker->image())
                                    ->setCreatedAt($faker->dateTimeImmutable());
            $articles[] = $article;
            $article->setAuthor($users[rand(0, count($users)-1)]);
            $manager->persist($article);
        }

        $events = [];
        for ($i=0; $i < 2; $i++) {
            $event = (new Event())->setStartDate($faker->dateTimeImmutable())
                                    ->setEndDate($faker->dateTimeImmutable())
                                    ->setTitle($faker->title())
                                    ->setContent($faker->text(10, 100));
            $events[] = $event;
            $manager->persist($event);
        }

        $events = [];
        for ($i=0; $i < 2; $i++) {
            $event = (new Event())->setStartDate($faker->dateTimeImmutable())
                                    ->setTitle($faker->title())
                                    ->setContent($faker->text(10, 50));
            $events[] = $event;
            $manager->persist($event);
        }
        $filieres = [];
        $my_array = array("Sciences infirmieres", "Sage femme", "Sante communautaire", "Technique de laboratoire", "Technique pharmaceutique", "Gestion des organisations de sante", "Sciences des aliments (Nutrition diététique)", "EASI: Enseignement et administration en soinsoins infirmiers", );
        foreach ($my_array as $value) {
            $filiere = (new Filiere())->setTitle($value)
                                    ->setDescription($faker->text(5, 10));
            
            $filieres[] = $filiere;
            $manager->persist($filiere);
        }

        $studentbooks = [];
        for ($i=0; $i < 25; $i++) {
            $studentbook = (new StudentBook())->setTitle($faker->title())
                                                ->setDescription($faker->text(10, 30))
                                                ->setStudentFullName($faker->full_name())
                                                ->setYear($faker->dateTime())
                                                ->setFileUrl("https://drive.google.com/file/d/1eubvbL5ZXGTH0WmA6d6sywwI1uIAy37f/view")
                                                ->setFiliere($filieres[rand(0, count($filieres)-1)]);
        
        $studentbooks[] = $studentbook;
        $manager->persist($studentbook);
        }

        $manager->flush();
    }
}
