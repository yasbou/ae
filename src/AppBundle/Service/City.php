<?php
namespace AppBundle\Service;

use AppBundle\Entity\BigCity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;



class City
{
	private $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

   public function getBigCity()
    {
        //$bigCity = 'hello';
       return $bigCity = $this->em->getRepository(BigCity::class)->findAll();

   }
}
