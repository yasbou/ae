<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Extension\SecurityExtension;
use AppBundle\Entity\BigCity;
use AppBundle\Entity\Service;
use AppBundle\Entity\User;
use AppBundle\Entity\Devis;

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
     * @Route("/service/{id}/show/", name="show")
     *
     */

    public function showAction(Request $request, User $user, EntityManagerInterface $em, \Swift_Mailer $mailer)
    {
        $devis = new Devis();
        $form = $this->createForm('AppBundle\Form\DevisType', $devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $devis->setuser($user);


            $em = $this->getDoctrine()->getManager();
            $em->persist($devis);
            $em->flush();


            $message = \Swift_Message::newInstance()
            ->setSubject('alerte devis')
            ->setFrom('yacine.bouhsen@gmail.com')
            ->setTo('yacine.bouhsen@gmail.com')
            ->setBody(
                $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        'Emails/registration.html.twig'),
                        'text/html'
                        )
                        ;

        $this->get('mailer')->send($message);
            return $this->redirectToRoute('devis',['id' => $user->getId()]);
        }
    return $this->render('arabianE/service/show.html.twig', [

        'user' => $user,
        'devis' => $devis,
        'form' => $form->createView(),
    ]);
    }

    /**
     * @Route("/devis", name="devis")
     *
     */

    public function validDevisAction()
    {

        return $this->render('arabianE/service/devis.html.twig');
    }

}
