<?php

namespace FaimfonyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="first_name", type="string", length=255)
     *
     */
    protected $first_name;

    /**
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    protected $last_name;

    /**
     * @ORM\Column(name="phone", type="string", length=10)
     */
    protected $phone;

    /**
     * @var string $slug;
     *
     * @Gedmo\Slug(fields={"first_name", "last_name"}, updatable=false, separator="-")
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\Column(name="user_type", type="string", length=255)
     */
    protected $user_type;

    /**
     * @ORM\Column(name="resto_name", type="string", length=255, nullable=true)
     */
    protected $resto_name;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="user")
     */
    protected $addresses;


    /**
     * @ORM\Column(name="cooking_type", type="string", length=255, nullable=true)
     */
    protected $cooking_type;


    /**
     * @ORM\Column(name="min_price", type="integer", nullable=true)
     */
    protected $min_price;

    /**
     * @ORM\Column(name="max_price", type="integer", nullable=true)
     */
    protected $max_price;

    /**
     * @ORM\OneToMany(targetEntity="Timetable", mappedBy="user")
     */
    protected $timetable;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="resto_tags",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *     )
     */
    protected $tags;

    public function __construct()
    {
        parent::__construct();
        if($this->resto_name != ""){
            $this->setSlug($this->resto_name);
        }
        $this->address = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set userType
     *
     * @param string $userType
     *
     * @return User
     */
    public function setUserType($userType)
    {
        $this->user_type = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return string
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * Set restoName
     *
     * @param string $restoName
     *
     * @return User
     */
    public function setRestoName($restoName)
    {
        $this->resto_name = $restoName;

        return $this;
    }

    /**
     * Get restoName
     *
     * @return string
     */
    public function getRestoName()
    {
        return $this->resto_name;
    }

    /**
     * Set cookingType
     *
     * @param string $cookingType
     *
     * @return User
     */
    public function setCookingType($cookingType)
    {
        $this->cooking_type = $cookingType;

        return $this;
    }

    /**
     * Get cookingType
     *
     * @return string
     */
    public function getCookingType()
    {
        return $this->cooking_type;
    }

    /**
     * Set minPrice
     *
     * @param integer $minPrice
     *
     * @return User
     */
    public function setMinPrice($minPrice)
    {
        $this->min_price = $minPrice;

        return $this;
    }

    /**
     * Get minPrice
     *
     * @return integer
     */
    public function getMinPrice()
    {
        return $this->min_price;
    }

    /**
     * Set maxPrice
     *
     * @param integer $maxPrice
     *
     * @return User
     */
    public function setMaxPrice($maxPrice)
    {
        $this->max_price = $maxPrice;

        return $this;
    }

    /**
     * Get maxPrice
     *
     * @return integer
     */
    public function getMaxPrice()
    {
        return $this->max_price;
    }

    /**
     * Add address
     *
     * @param \FaimfonyBundle\Entity\Address $address
     *
     * @return User
     */
    public function addAddress(\FaimfonyBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \FaimfonyBundle\Entity\Address $address
     */
    public function removeAddress(\FaimfonyBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add timetable
     *
     * @param \FaimfonyBundle\Entity\Timetable $timetable
     *
     * @return User
     */
    public function addTimetable(\FaimfonyBundle\Entity\Timetable $timetable)
    {
        $this->timetable[] = $timetable;

        return $this;
    }

    /**
     * Remove timetable
     *
     * @param \FaimfonyBundle\Entity\Timetable $timetable
     */
    public function removeTimetable(\FaimfonyBundle\Entity\Timetable $timetable)
    {
        $this->timetable->removeElement($timetable);
    }

    /**
     * Get timetable
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTimetable()
    {
        return $this->timetable;
    }

    /**
     * Add tag
     *
     * @param \FaimfonyBundle\Entity\Tag $tag
     *
     * @return User
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

    public function setEmail($email)
    {
        $this->setUsername($email);
        return parent::setEmail($email); // TODO: Change the autogenerated stub

    }
}
