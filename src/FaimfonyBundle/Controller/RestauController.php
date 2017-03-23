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
}
