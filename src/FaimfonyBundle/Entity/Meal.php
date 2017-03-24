<?php

namespace FaimfonyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Meal
 *
 * @ORM\Table(name="meal")
 * @ORM\Entity(repositoryClass="FaimfonyBundle\Repository\MealRepository")
 */
class Meal
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="meals")
     * @ORM\JoinTable(name="meals_tags")
     */
    protected $tags;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="favorites")
     */
    protected $users;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="meals")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id");
     */
    protected $restaurant;

    function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * @return Meal
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
     * Set description
     *
     * @param string $description
     *
     * @return Meal
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Meal
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add tag
     *
     * @param \FaimfonyBundle\Entity\Tag $tag
     *
     * @return Meal
     */
    public function addTag(\FaimfonyBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \FaimfonyBundle\Entity\Tag $tag
     */
    public function removeTag(\FaimfonyBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add user
     *
     * @param \FaimfonyBundle\Entity\User $user
     *
     * @return Meal
     */
    public function addUser(\FaimfonyBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \FaimfonyBundle\Entity\User $user
     */
    public function removeUser(\FaimfonyBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set image
     *
     * @param \FaimfonyBundle\Entity\Image $image
     *
     * @return Meal
     */
    public function setImage(\FaimfonyBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \FaimfonyBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set restaurant
     *
     * @param \FaimfonyBundle\Entity\Restaurant $restaurant
     *
     * @return Meal
     */
    public function setRestaurant(\FaimfonyBundle\Entity\Restaurant $restaurant = null)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return \FaimfonyBundle\Entity\Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
