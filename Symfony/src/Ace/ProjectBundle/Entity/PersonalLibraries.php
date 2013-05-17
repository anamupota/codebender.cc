<?php
// src/Ace/ProjectBundle/Entity/PersonalLibraries.php

namespace Ace\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ace\UserBundle\Entity\User;

/**
 * @ORM\Entity
 */
class PersonalLibraries
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ace\UserBundle\Entity\User")
     **/
    protected $owner;

    /**
	 * @ORM\Column(type="string", length="255")
	 */
    protected  $description;

    /**
     * @ORM\Column(type="date")
     */
    protected  $starts ;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected  $expires;


    /**
     * @ORM\Column(type="integer")
     */
    protected  $number;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_public;

    public function __construct()
    {
        $this->setStarts(new \DateTime("now"));
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Set starts
     *
     * @param date $starts
     */
    public function setStarts($starts)
    {
        $this->starts = $starts;
    }

    /**
     * Get expires
     *
     * @return starts
     */
    public function getStarts()
    {
        return $this->starts;
    }

    /**
     * Set expires
     *
     * @param date $expires
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
    }

    /**
     * Get expires
     *
     * @return date
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set number
     *
     * @param integer $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set owner
     *
     * @param Ace\UserBundle\Entity\User $owner
     */
    public function setOwner(\Ace\UserBundle\Entity\User $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return Ace\UserBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set is_public
     *
     * @param boolean $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;
    }

    /**
     * Get is_public
     *
     * @return boolean
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }
}
