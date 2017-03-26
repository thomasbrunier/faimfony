<?php
namespace FaimfonyBundle\Controller;

use FaimfonyBundle\Entity\Meal;
use FaimfonyBundle\Entity\Restaurant;
use FaimfonyBundle\Form\MealType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MealController extends Controller
{

    /**
     * @Route("meal/create/{id}", name="add_meal")
     */

    public function mealCreateAction(Request $request, $id)
    {

        $restauRepository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restau = $restauRepository->find($id);

        $meal = new Meal();

        $form = $this->CreateForm(MealType::class, $meal);
//        $user = $this->getUser();
        $form->handleRequest($request);
        $meal->setRestaurant($restau);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($meal);
            $em->flush();
            return $this->redirect($this->generateUrl('profil_restau', array('id'=>$restau->getId())));
        }
        return $this->render('FaimfonyBundle:Default:mealFormulaire.html.twig', array('form' => $form->createView()
        ));
    }


}
