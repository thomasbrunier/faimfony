<?php

namespace FaimfonyBundle\Controller;

use FaimfonyBundle\Entity\Meal;
use FaimfonyBundle\Entity\Restaurant;
use FaimfonyBundle\Form\UserMealType;
use FaimfonyBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    /**
     * @Route("/profil/", name="user_profil")
     */
    public function userProfilAction(Request $request) {

        $user = $this->getUser();
        $userId = $user->getId();
        $meal = new Meal();
        $form = $this->createForm(UserMealType::class, $meal);


        $restauRepository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restaus = $restauRepository->findByUser($userId);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            dump($meal->getTags()[0]->getName());
            $mealRepo = $this->getDoctrine()->getRepository(Meal::class);
            $meals = $mealRepo->userFindMeal($meal->getPrice(), $meal->getTags());


            return $this->render('FaimfonyBundle:Default:userProfil.html.twig', array('user'=>$user, 'restaus'=>$restaus, 'meals'=>$meals));
        }

        return $this->render('FaimfonyBundle:Default:userProfil.html.twig', array('user'=>$user, 'restaus'=>$restaus, 'form'=>$form->createView()));
    }

    /**
     * @Route("/profil/edit", name="user_edit");
     */
    public function userEditAction(Request $request) {
        $session = new Session();
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $session->getFlashBag()->add('notice', 'Profil mis à jour');


            return $this->redirect($this->generateUrl('user_edit'));
        }


        return $this->render('FaimfonyBundle:Default:editProfil.html.twig', array('user_form'=>$form->createView()));
    }


}
