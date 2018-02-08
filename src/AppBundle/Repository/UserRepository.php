<?php

namespace AppBundle\Repository;


class UserRepository extends \Doctrine\ORM\EntityRepository
{

  public function findIfExist()
   {
       return $this->getEntityManager()
           ->createQuery(
               'SELECT password FROM AppBundle:User'
           )
           ->getResult();
   }
}
