<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Picture;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity
 */
 
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     * @Assert\File(mimeTypes={"image/gif", "image/jpeg", "image/png"})
     */
    private $logo;


    /**
     * @ORM\Column(type="string", length=25)
     */
    private $compagnyName;


    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $numstrett;

    /**
     * @ORM\Column(type="string", length=60 )
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=60 )
     */
    private $codepostale;

    /**
     * @ORM\Column(type="string", length=60 )
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=10 )
     */
    private $telephone;

    /**
     * @ORM\ManyToOne(targetEntity="BigCity", inversedBy="users" )
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="users")
     */
    private $service;

    /**
     * @ORM\OneToMany(targetEntity="Picture", mappedBy="user")
     *
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity="Devis", mappedBy="user")
     *
     */
    private $devis;







    public function __construct()
    {
        $this->isActive = true;
         $this->pictures = new ArrayCollection();
         $this->devis = new ArrayCollection();
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_PRO');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set the value of Username
     *
     * @param mixed username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Is Active
     *
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of Is Active
     *
     * @param mixed isActive
     *
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }



    /**
     * Get the value of Numstrett
     *
     * @return mixed
     */
    public function getNumstrett()
    {
        return $this->numstrett;
    }

    /**
     * Set the value of Numstrett
     *
     * @param mixed numstrett
     *
     * @return self
     */
    public function setNumstrett($numstrett)
    {
        $this->numstrett = $numstrett;

        return $this;
    }

    /**
     * Get the value of Adress
     *
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set the value of Adress
     *
     * @param mixed adress
     *
     * @return self
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get the value of Codepostale
     *
     * @return mixed
     */
    public function getCodepostale()
    {
        return $this->codepostale;
    }

    /**
     * Set the value of Codepostale
     *
     * @param mixed codepostale
     *
     * @return self
     */
    public function setCodepostale($codepostale)
    {
        $this->codepostale = $codepostale;

        return $this;
    }

    /**
     * Get the value of Ville
     *
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of Ville
     *
     * @param mixed ville
     *
     * @return self
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }




    /**
     * Get the value of Telephone
     *
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of Telephone
     *
     * @param mixed telephone
     *
     * @return self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }



    /**
     * Get the value of Compagny Name
     *
     * @return mixed
     */
    public function getCompagnyName()
    {
        return $this->compagnyName;
    }

    /**
     * Set the value of Compagny Name
     *
     * @param mixed compagnyName
     *
     * @return self
     */
    public function setCompagnyName($compagnyName)
    {
        $this->compagnyName = $compagnyName;

        return $this;
    }



    /**
     * Get the value of City
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of City
     *
     * @param mixed city
     *
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }





    /**
     * Get the value of Service
     *
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the value of Service
     *
     * @param mixed service
     *
     * @return self
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }




    /**
     * Get the value of Pictures
     *
     * @return mixed
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Set the value of Pictures
     *
     * @param mixed pictures
     *
     * @return self
     */
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;

        return $this;
    }

//    public function addUser(Picture $user)
//    {
//        $this->pictures[] = $user;
//            // On associé la catégorie courante au produit passé en paramètre
//            $user->setCategory($this);
//            return $this;
//    }



    /**
     * Get the value of Devis
     *
     * @return mixed
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * Set the value of Devis
     *
     * @param mixed devis
     *
     * @return self
     */
    public function setDevis($devis)
    {
        $this->devis = $devis;

        return $this;
    }



    /**
     * Get the value of Logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set the value of Logo
     *
     * @param string logo
     *
     * @return self
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

}
