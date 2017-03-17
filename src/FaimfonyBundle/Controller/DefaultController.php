<?php

namespace FaimfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request){
        $user = $this->getUser();
        if($user != null){
            return $this->redirect($this->generateUrl('user_profil', array()));
        }
        else{
            return $this->redirect($this->generateUrl("register_form"));
        }
    }
}
