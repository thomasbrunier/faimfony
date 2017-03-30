<?php
/**
 * Created by PhpStorm.
 * User: brunierthomas
 * Date: 09/03/2017
 * Time: 15:31
 */

namespace JoliBlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use JoliBlogBundle\Entity\Post;

class LoadUserFixtures implements FixtureInterface {

    function load(ObjectManager $manager)
    {
        $i = 1;
        while ($i <= 100) {
            $post = new Post();
            $post->setTitle('Titre du post n°'.$i);
            $post->setBody('Corps du post');
            $post->setIsPubblished($i%2);
            $manager->persist($post);

            $i++;
        }
        $manager->flush();
    }

}