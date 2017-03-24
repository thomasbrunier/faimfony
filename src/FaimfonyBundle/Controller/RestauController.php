<?php
namespace FaimfonyBundle\Controller;

use FaimfonyBundle\Entity\Meal;
use FaimfonyBundle\Entity\Restaurant;
use FaimfonyBundle\Form\RestaurantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class RestauController extends Controller
{

    /**
     * @Route("restaurant/create/", name="add_restau")
     */

    public function restauAction(Request $request)
    {

        $restaurant = new Restaurant();

        $form = $this->CreateForm(RestaurantType::class, $restaurant);
        $user = $this->getUser();
        $form->handleRequest($request);
        $restaurant->setUser($user);
        $dayArray = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
        $timetableArray = [];
        foreach ($dayArray as $day => $time) {
            $timetableArray[$time][] = $form->get($time . ':ouverture')->getData();
            $timetableArray[$time][] = $form->get($time . ':fermeture')->getData();
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
        return $this->render('FaimfonyBundle:Default:restaurantFormulaire.html.twig', array('form' => $form->createView()
        ));
    }

    /**
     * @Route("restaurant/{id}", name="profil_restau")
     */

    public function profilRestauAction($id)
    {

        $restauRepository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restau = $restauRepository->find($id);

        $MealRepository = $this->getDoctrine()->getRepository(Meal::class);
        $meals = $MealRepository->findByRestaurant($id);

//        $meals = [
//            'meal1' => [
//                'description' => '',
//                'id' => '1',
//                'image_id' => '',
//                'name' => 'burger',
//                'price' => ''
//            ],
//            'meal2' => [
//                'description' => '',
//                'id' => '2',
//                'image_id' => '',
//                'name' => 'salade',
//                'price' => ''
//            ]
//        ];

        $user = $this->getUser();
        if ($user != null) {
//            If restau belongs to user
            $userIsOwner = true;
        } else {
            $userIsOwner = false;
        }

        return $this->render('FaimfonyBundle:Default:restauProfil.html.twig', array(
            'id' => $id,
            'userIsOwner' => $userIsOwner,
            'restau' => $restau,
            'meals' => $meals
        ));
    }

    /**
     * @Route("restaurant/edit/{id}", name="edit_restau")
     */

    public function restauEditAction(Request $request, $id)
    {

       $session = new Session();
        $user = $this->getUser();
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
        $form = $this->createForm(RestaurantType::class, $restaurant);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $session->getFlashBag()->add('notice', 'Profil mis à jour');


            return $this->redirect($this->generateUrl('edit_restau', array('id'=>$id)));
        }


        return $this->render('FaimfonyBundle:Default:editRestau.html.twig', array('restau_form'=>$form->createView(), 'restaurant'=>$restaurant));



//        return $this->render('FaimfonyBundle:Default:restaurantFormulaire.html.twig', array('form' => $form->createView()
//        ));
    }


}
