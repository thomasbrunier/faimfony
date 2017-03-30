<?php

namespace FaimfonyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="FaimfonyBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Meal", mappedBy="tags")
     */
    protected $meals;

    public function __construct(){
        $this->meals = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set meal
     *
     * @param \FaimfonyBundle\Entity\Meal $meal
     *
     * @return Tag
     */
    public function setMeal(\FaimfonyBundle\Entity\Meal $meal = null)
    {
        $this->meal = $meal;

        return $this;
    }

    /**
     * Get meal
     *
     * @return \FaimfonyBundle\Entity\Meal
     */
    public function getMeals()
    {
        return $this->meals;
    }

    /**
     * Add meal
     *
     * @param \FaimfonyBundle\Entity\Meal $meal
     *
     * @return Tag
     */
    public function addMeals(\FaimfonyBundle\Entity\Meal $meal)
    {
        $this->meals[] = $meal;

        return $this;
    }

    /**
     * Remove meal
     *
     * @param \FaimfonyBundle\Entity\Meal $meal
     */
    public function removeMeals(\FaimfonyBundle\Entity\Meal $meal)
    {
        $this->meals->removeElement($meal);
    }

    /**
     * Add meal
     *
     * @param \FaimfonyBundle\Entity\Meal $meal
     *
     * @return Tag
     */
    public function addMeal(\FaimfonyBundle\Entity\Meal $meal)
    {
        $this->meals[] = $meal;

        return $this;
    }

    /**
     * Remove meal
     *
     * @param \FaimfonyBundle\Entity\Meal $meal
     */
    public function removeMeal(\FaimfonyBundle\Entity\Meal $meal)
    {
        $this->meals->removeElement($meal);
    }

    /**
     * Get meal
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeal()
    {
        return $this->meal;
    }
}
