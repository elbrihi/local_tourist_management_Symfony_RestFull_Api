<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="prices",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="prices_type_place_unique", columns={"type", "place_id"})}
 * )
 */
class Price
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id ;

     /**
     * @ORM\Column(name="type")
     */
    protected $type ;

    /**
     * @ORM\Column(name="value")
     */
    protected $value ;

     /**
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="prices",cascade={"all"}) //  it means that Pice is the subgroupe of Place
     * @var Place
     */
    protected $place;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    public function getPlace()
    {
        return $this->place;
    }

    
   

}