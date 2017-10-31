<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Picture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Form\PictureType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;

class PrestataireController extends Controller
{

    /**
     * @Route("/prestataire", name="prestataire")
     */
    public function prestataireAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plainPassword = $user->getPassword();
            $encoded = $encoder->encodePassword($user, $plainPassword);

            $user->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('profile', array('id' => $user->getId()));
        }
        return $this->render('arabianE/prestataire/prestataire.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);

    }




    /**
     * @Route("/prestataire/profile", name="profile")
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
        return $this->render('arabianE/prestataire/profile.html.twig', [

            'picture' => $picture,
            'formPicture' => $formPicture->createView(),
        ]);

    }
}
