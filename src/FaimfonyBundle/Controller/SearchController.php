<?php
/**
 * Created by PhpStorm.
 * User: lepadellec
 * Date: 29/03/2017
 * Time: 15:29
 */

namespace FaimfonyBundle\Controller;

use FaimfonyBundle\Entity\Meal;
use FaimfonyBundle\Entity\Restaurant;
use FaimfonyBundle\Form\RestaurantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SearchController extends Controller
{

    /**
     * @Route("/search", name="search")
     */

    public function searchAction(Request $request)
    {
        $slug = $request->query->get("s");

        $repository = $this->getDoctrine()->getRepository(Meal::class);
        $meals = $repository->searchMeal($slug);
        $names = array();

        foreach ($meals as &$meal) {
            /* @var Meal $meal */
            $names[] = $meal->getName();
        }
        return new JsonResponse($names);

    }
}