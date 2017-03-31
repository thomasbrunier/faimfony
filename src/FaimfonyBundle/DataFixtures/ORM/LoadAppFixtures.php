<?php

namespace FaimfonyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use FaimfonyBundle\Entity\Image;
use FaimfonyBundle\Entity\Meal;
use FaimfonyBundle\Entity\Restaurant;
use FaimfonyBundle\Entity\Tag;
use FaimfonyBundle\Entity\User;

class LoadAppFixtures implements FixtureInterface {

    function load(ObjectManager $manager)
    {

        $timetable = "{\"lundi\":[\"10:00:00\",\"15:00:00\"],\"mardi\":[\"10:00:00\",\"15:00:00\"],\"mercredi\":[\"10:00:00\",\"15:00:00\"],\"jeudi\":[\"10:00:00\",\"15:00:00\"],\"vendredi\":[\"18:00:00\",\"23:00:00\"],\"samedi\":[\"18:00:00\",\"23:00:00\"],\"dimanche\":[\"10:00:00\",\"15:00:00\"]}";

        $u = 1;
        while ($u <= 10) {
            $user = new User();
            $user->setEmail('user'.$u.'@test.com');
            $user->setPlainPassword('user'.$u);
            $user->setEnabled(true);
            $user->setFirstName('User'.$u);
            $user->setLastName('Nom'.$u);
            $user->setPhone('0123456789');
            $user->setIsCooker(true);

            $r = 1;
            while ($r <= 3) {

                $image = new Image();
                $image->setUrl('http://placehold.it/350x150');
                $image->setAlt('placeholder restaurant image '.$u.$r);
                $manager->persist($image);

                $restau = new Restaurant();
                $restau->setName('Chez User'.$u.'('.$r.')');
                $restau->setAddress($r.', rue du User '.$u);
                $restau->setTimetable($timetable);
                $restau->setPhone('0123456789');
                $restau->setUser($user);
                $restau->setImage($image);

                $m = 1;
                while ($m <= 3) {

                    $Mealimage = new Image();
                    $Mealimage->setUrl('http://placehold.it/350x150');
                    $Mealimage->setAlt('placeholder meal image '.$u.$r.$m);
                    $manager->persist($Mealimage);

                    $meal = new Meal();
                    $meal->setImage($Mealimage);
                    $meal->setName('Plat '.$u.$r.$m);
                    $meal->setDescription('Un super bon plat');
                    $meal->setPrice('10');
                    $meal->setRestaurant($restau);

                    $t = 1;
                    while ($t <= 3) {
                        $tag = new Tag();
                        $tag->setName('tag'.$u.$r.$m.$t);
                        $meal->addTag($tag);

                        $manager->persist($tag);
                        $t++;
                    }

                    $manager->persist($meal);
                    $m++;
                }

                $manager->persist($restau);
                $r++;
            }

            $manager->persist($user);
            $u++;
        }
        $manager->flush();
    }

}