<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BigCity;
use AppBundle\Entity\Service;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction()
    {
         $bigCity = $this->getDoctrine()->getRepository(BigCity::class)->findAll();
         $service = $this->getDoctrine()->getRepository(Service::class)->findAll();
        return $this->render('arabianE/home.html.twig', [
            'bigCity' => $bigCity,
            'service' => $service,
        ]);
    }

}
