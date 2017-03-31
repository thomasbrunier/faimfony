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
use FaimfonyBundle\Entity\Tag;
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

    /**
     * @Route("/searchTags", name="search_tags")
     */

    public function searchTagsAction(Request $request)
    {
        $slug = $request->query->get("s");

        $repository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $repository->searchTag($slug);
        $names = array();

        foreach ($tags as &$tag) {
            /* @var Tag $tag */
            $names[] = $tag->getName();
        }
        return new JsonResponse($names);

    }

    /**
     * @Route("/searchMeal", name="search_meal")
     */

    public function searchMealAction(Request $request)
    {
        $b = $request->query->get("b");
        $t = $request->query->get("t");

        $tag = new Tag();
        $tag->setName($t);

        $tagRepos = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $tagRepos->findByName($tag->getName());

//        $meal = new Meal();
//        $meal->setPrice($budget);
//        $meal->addTag($tag);

        $repository = $this->getDoctrine()->getRepository(Meal::class);

//        $meals = $repository->searchMeal($slug);

        $meals = $repository->userFindMeal($b,$tags);
//        $meals = $repository->userFindMeal($budget,$tag);
//
        $names = array();
        $i = 0;

        foreach ($meals as &$meal) {
            /* @var Meal $meal */
            $names[$i]['name'] = $meal->getName();
            $names[$i]['price'] = $meal->getPrice();
            $names[$i]['id'] = $meal->getId();
            $names[$i]['desc'] = $meal->getDescription();
            $names[$i]['photoUrl'] = $meal->getImage()->getUrl();
            $names[$i]['restauId'] = $meal->getRestaurant()->getId();
            $i++;
        }
//
//
//        $names = [$b,$tags];


        return new JsonResponse($names);

    }
}