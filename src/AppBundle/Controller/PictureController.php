<?php
namespace AppBundle\Controller;

use AppBundle\Controller\HomeController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\PictureType;
use AppBundle\Entity\Picture;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityManagerInterface;

class PictureController extends HomeController
{

    /**
     * @Route("/profile/picture", name="managePicture")
     */
    public function profileAction(Request $request)
    {
        $picture = new Picture();
        $formPicture = $this->createForm(PictureType::class, $picture);
        $formPicture->handleRequest($request);

        if ($formPicture->isSubmitted() && $formPicture->isValid()) {

            $pictureName= $picture->getName();
            $filename= md5(uniqid()).'.'.$pictureName->guessExtension();
            $pictureName->move($this->getParameter('upload_directory'), $filename);
            $picture->setName($filename);

            $user= $this->get('security.token_storage')->getToken()->getUser();
            $picture->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($picture);
            $em->flush();

            return $this->redirectToRoute('profile');
        }
        return $this->render('arabianE/prestataire/managePicture.html.twig', [

            'picture' => $picture,
            'formPicture' => $formPicture->createView(),
        ]);

    }



     /**
       * @Route("/deletePicture/{id}", name="deletePicture")
       */
      public function deleteAction( EntityManagerInterface $em, Picture $picture)
      {

              $em->remove($picture);
              $em->flush();


          return $this->redirectToRoute('profile');
      }

}
