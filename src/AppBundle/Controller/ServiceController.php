<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Extension\SecurityExtension;
use AppBundle\Entity\BigCity;
use AppBundle\Entity\Service;


class ServiceController extends Controller
{
    /**
     * @Route("/service/{id}", name="service")
     *
     */
    public function showAction(Service $service)
    {

        return $this->render('arabianE/service/service.html.twig', [
            'service' => $service,
        ]);

    }
}
