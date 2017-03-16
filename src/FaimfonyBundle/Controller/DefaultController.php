<?php

namespace FaimfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('FaimfonyBundle:Default:index.html.twig');
    }



    /**
     * @Route("/{slug}", name="user_profil")
     */
    public function userProfilAction(){
        return $this->render('FaimfonyBundle:Default:index.html.twig');
    }
}
