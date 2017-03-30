<?php

namespace FaimfonyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use FaimfonyBundle\Entity\Image;
use FaimfonyBundle\Entity\Restaurant;
use FaimfonyBundle\Entity\User;

class LoadAppFixtures implements FixtureInterface {

    function load(ObjectManager $manager)
    {

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
                $image->setAlt('placeholder image '.$u.$r);
                $manager->persist($image);

                $restau = new Restaurant();
                $restau->setName('Chez User'.$u.'('.$r.')');
                $restau->setAddress($r.', rue du User '.$u);
                $restau->setTimetable('horaires');
                $restau->setPhone('0123456789');
                $restau->setUser($user);
                $restau->setImage($image);

                $manager->persist($restau);
                $r++;
            }

            $manager->persist($user);
            $u++;
        }
        $manager->flush();
    }

}