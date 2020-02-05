<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;



/**
 * @ORM\Entity()
 * @ORM\Table(name="places",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="places_name_unique",columns={"name"})}
 * )
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="name",type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="address",type="string")
     */
    protected $address;

    /**
     * @ORM\OneToMany(targetEntity="Price",mappedBy="place")
     * @var Price[]
     */
    private $prices;

    /**
     * @ORM\OneToMany(targetEntity="Theme",mappedBy="place")
     * @var Theme[]
     * 
     */
     private $themes ;
     
    public function __construct()
    {
        $this->prices = new ArrayCollection();
        $this->themes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getPrices()
    {
        return $this->prices;
    }

    public function setThemes($themes)
    {
        $this->themes = $themes;
    }
    
    public function getThemes()
    {
        return $this->themes;
    }
    
}