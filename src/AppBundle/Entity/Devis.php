<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Picture;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Devis
 *
 * @ORM\Table(name="devis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DevisRepository")
 */
class Devis
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
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreDePersonne", type="integer")
     */
    private $nombreDePersonne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="guestEmail", type="string", length=255)
     */
    private $guestEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="guestTel", type="string", length=255)
     */
    private $guestTel;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="devis")
     */
    private $user;



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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Devis
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Devis
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set nombreDePersonne
     *
     * @param integer $nombreDePersonne
     *
     * @return Devis
     */
    public function setNombreDePersonne($nombreDePersonne)
    {
        $this->nombreDePersonne = $nombreDePersonne;

        return $this;
    }

    /**
     * Get nombreDePersonne
     *
     * @return int
     */
    public function getNombreDePersonne()
    {
        return $this->nombreDePersonne;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Devis
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set guestEmail
     *
     * @param string $guestEmail
     *
     * @return Devis
     */
    public function setGuestEmail($guestEmail)
    {
        $this->guestEmail = $guestEmail;

        return $this;
    }

    /**
     * Get guestEmail
     *
     * @return string
     */
    public function getGuestEmail()
    {
        return $this->guestEmail;
    }

    /**
     * Set guestTel
     *
     * @param string $guestTel
     *
     * @return Devis
     */
    public function setGuestTel($guestTel)
    {
        $this->guestTel = $guestTel;

        return $this;
    }

    /**
     * Get guestTel
     *
     * @return string
     */
    public function getGuestTel()
    {
        return $this->guestTel;
    }



    /**
     * Get the value of User
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of User
     *
     * @param mixed user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

}
