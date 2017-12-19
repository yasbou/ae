<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BigCity;
use AppBundle\Entity\Service;
use AppBundle\Service\City;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction(City $city)
    {

         $service = $this->getDoctrine()->getRepository(Service::class)->findAll();
        return $this->render('arabianE/home.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/QuiNousSommes", name="QuiNousSommes")
     */

    public function quiNousSommesAction()
    {
        return $this->render('arabianE/Quinoussommes.html.twig');

    }

}
