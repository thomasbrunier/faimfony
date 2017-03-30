<?php

namespace FaimfonyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use FaimfonyBundle\Entity\User;

class LoadUserFixtures implements FixtureInterface {

    function load(ObjectManager $manager)
    {
        $i = 1;
        while ($i <= 10) {
            $user = new User();
            $user->setFirstName('Prénom'.$i);
            $user->setLastName('Nom'.$i);
            $user->setPhone('0123456789');
            $user->setIsCooker(true);
            $manager->persist($user);

            $i++;
        }
        $manager->flush();
    }

}