<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Devis;
use Doctrine\ORM\EntityManagerInterface;

class DevisController extends Controller
{
    /**
     * @Route("/profile/devis", name="devis_show")
     */
    public function showDevisAction()
    {


        return $this->render('arabianE/prestataire/devis.html.twig');
    }


}
