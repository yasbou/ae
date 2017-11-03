<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Extension\SecurityExtension;
use AppBundle\Entity\BigCity;
use AppBundle\Entity\Service;
use AppBundle\Entity\User;

class ServiceController extends Controller
{
    /**
     * @Route("/service/{id}", name="service")
     *
     */
    public function listAction(Service $service)
    {

        return $this->render('arabianE/service/list.html.twig', [
            'service' => $service,
        ]);

    }

    /**
     * @Route("/service/{id}/show", name="show")
     *
     */

    public function showAction(User $user)
    {

    return $this->render('arabianE/service/show.html.twig', [
        'user' => $user,
    ]);
    }
}
