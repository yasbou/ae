<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PrestataireController extends Controller
{
    /**
     * @Route("/prestataire/profile")
     */
    public function prestataireAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
