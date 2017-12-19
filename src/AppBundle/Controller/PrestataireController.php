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
use Symfony\Component\HttpFoundation\File\File;

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

            $logoname= $user->getLogo();
            $filename= md5(uniqid()).'.'.$logoname->guessExtension();
            $logoname->move($this->getParameter('upload_directory'), $filename);
            $user->setLogo($filename);

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

        return $this->render('arabianE/prestataire/profile.html.twig');

    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/prestataire/profile/edit/{id}", name="edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user, UserPasswordEncoderInterface $encoder)
    {

        $currentLogo= $user->getLogo();

        if (!empty($user->getLogo())) {

            $user->setLogo(new File($this->getParameter('upload_directory').'/'.$user->getLogo()));
        }

        // On stocke le mot de passe courant
      // Ici getPassword() contient le pass en bdd
      $currentPassword = $user->getPassword();
      $user->setPassword('');
      $deleteForm = $this->createDeleteForm($user);
      // Le user sera - éventuellement - modifié uniquemnt à partir d'ici
      $editForm = $this->createForm('AppBundle\Form\UserType', $user, ['edit'=> true]);
      $editForm->handleRequest($request);
      if ($editForm->isSubmitted() && $editForm->isValid()) {

          $logoname= $user->getLogo();

            if ($logoname) {

                $filename= md5(uniqid()).'.'.$logoname->guessExtension();
                $logoname->move($this->getParameter('upload_directory'), $filename);
                $user->setLogo($filename);
            }
            else {
                $user->setLogo($currentLogo);
            }

          if(!empty($user->getPassword())) {
              // Encodage du mot de passe présent dans le form
              $encoded = $encoder->encodePassword($user, $user->getPassword());
              // Sauvegarde du nouveau mot de passe
              $user->setPassword($encoded);
          }
          else{
              $user->setPassword($currentPassword);
          }
          $this->getDoctrine()->getManager()->flush();
          return $this->redirectToRoute('profile');
      }
      return $this->render('arabianE/prestataire/edit.html.twig', array(
          'user' => $user,
          'edit_form' => $editForm->createView(),
          'delete_form' => $deleteForm->createView(),
      ));
  }


  /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            // Flash message
            $this->addFlash('success', 'User supprimé(e).');
        }
        return $this->redirectToRoute('home');
    }


  /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

  }
