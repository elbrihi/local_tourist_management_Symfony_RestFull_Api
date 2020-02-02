<?php 
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="preference",
 * uniqueConstraints={@ORM\UniqueConstraint(columns={"name"})}
 * )
 */
class Preference
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue()
     */
    protected $id;

    /**
     * @ORM\Column(name="name",type="string")
     */
    protected $name;

    /**
     * 
     * @ORM\Column(name="value",type="integer")
     */
    protected $value;

    /**
     * 
     *@ORM\ManyToOne(targetEntity="User", inversedBy="preferences") 
     */
    protected $user;

    public function setName($name)
    {
        $this->name = $name ;
        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }
}