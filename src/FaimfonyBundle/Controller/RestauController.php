<?php
namespace FaimfonyBundle\Controller;

use FaimfonyBundle\Entity\Restaurant;
use FaimfonyBundle\Form\RestaurantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class RestauController extends Controller{
    /**
     * @Route("restaurant/create/", name="add_restau")
     */

public function restauAction(Request $request){

    $restaurant = new Restaurant();

    $form = $this->CreateForm(RestaurantType::class, $restaurant);
    $user = $this->getUser();
    $form->handleRequest($request);
    $restaurant->setUser($user);
    $dayArray = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi','dimanche'];
    $timetableArray = [];
    foreach ($dayArray as $day => $time){
        $timetableArray[$time][] = $form->get($time.':ouverture')->getData();
        $timetableArray[$time][] = $form->get($time.':fermeture')->getData();
        //array_push($timetableArray, $form->get($day.':ouverture')->getData());
        //array_push($timetableArray ,$form->get($day.':fermeture')->getData());

    }
    if($form->isSubmitted() && $form->isValid()){
        $timetableArray = json_encode($timetableArray);
        $restaurant->setTimetable($timetableArray);
        $em = $this->getDoctrine()->getManager();
        $em->persist($restaurant);
        $em->flush();
    }
    return $this->render('FaimfonyBundle:Default:restaurantFormulaire.html.twig', array('form'=>$form->createView()
    ));
}
}
