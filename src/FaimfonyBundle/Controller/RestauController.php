<?php
namespace FaimfonyBundle\Controller;

use FaimfonyBundle\Entity\Restaurant;
use FaimfonyBundle\Form\RestaurantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class RestauController extends Controller{

    /**
     * @Route("restaurant/create/", name="add_restau")
     */

public function restauAction(){

    $Restaurant = new Restaurant();

    $form = $this->CreateForm(RestaurantType::class, $Restaurant);

    return $this->render('FaimfonyBundle:Default:restaurantFormulaire.html.twig', array('form'=>$form->createView()
    ));
}

    /**
     * @Route("restaurant/{id}", name="profil_restau")
     */

    public function profilRestauAction($id){

//        $restau = $this->getRestau($id);

        $timetable  = "{}";
        $mealsList  = [];

        $restau = [
            'urlPhoto'=>"http://placehold.it/1280x840",
            'name'=>'La buvette',
            'address'=>"100, rue de l'adresse",
            'timetable'=>$timetable,
            'phone'=>'1234567890',
            'mealsList'=>$mealsList
        ];

        $user = $this->getUser();
        if($user != null){
//            If restau belongs to user
            $userIsOwner = true;
        }
        else{
            $userIsOwner = false;
        }

        return $this->render('FaimfonyBundle:Default:restauProfil.html.twig', array(
            'id'=>$id,
            'userIsOwner'=>$userIsOwner,
            'restau'=>$restau
        ));
    }

}
