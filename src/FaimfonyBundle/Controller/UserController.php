<?php

namespace FaimfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/profil/{slug}", name="user_profil")
     */
    public function userProfilAction(){


        return $this->render('FaimfonyBundle:Default:editProfil.html.twig', array('profil_form'=>$form->createView()));
    }
}
