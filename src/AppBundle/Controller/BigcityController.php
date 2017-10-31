<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Extension\SecurityExtension;
use AppBundle\Entity\BigCity;
use AppBundle\Entity\Service;
use AppBundle\Service\City;

class BigcityController extends Controller
{
    /**
     * @Route("/ville/{id}", name="bigcity")
     *
     */
    public function showAction(Bigcity $city)
    {

        return $this->render('arabianE/prestataire/ville.html.twig', [
            'city' => $city,
        ]);

    }
}
