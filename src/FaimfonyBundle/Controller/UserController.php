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
        $favorites = $user->getFavorites();
        $restauRepository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restaus = $restauRepository->findByUser($userId);
        $formSubmitted = false;

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $formSubmitted = true;
            $mealRepo = $this->getDoctrine()->getRepository(Meal::class);
            $meals = $mealRepo->userFindMeal($meal->getPrice(), $meal->getTags());


            return $this->render('FaimfonyBundle:Default:userProfil.html.twig', array('user'=>$user, 'restaus'=>$restaus, 'form'=>$form->createView(), 'meals'=>$meals, 'favorites'=>$favorites, 'formSubmitted'=>$formSubmitted));
        }

        return $this->render('FaimfonyBundle:Default:userProfil.html.twig', array('user'=>$user, 'restaus'=>$restaus, 'form'=>$form->createView(), 'meals'=>'', 'favorites'=>$favorites, 'formSubmitted'=>$formSubmitted));
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


        return $this->render('FaimfonyBundle:Default:editProfil.html.twig', array('user'=>$user, 'user_form'=>$form->createView()));
    }


}
