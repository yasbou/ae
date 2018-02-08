<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BigCity;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Repository\UserRepository;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {

        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('arabianE/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,

        ));
    }



    /**
     * @Route("/resetpassword", name="resetpassword")
     */
    public function resetpasswordAction(Request $request, UserPasswordEncoderInterface $encoder, SessionInterface $session)
    {
      $form = $this->createForm('AppBundle\Form\ResetpassType');
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

        $userEmail= $form->get('Email')->getData();


        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('email' => $userEmail));

        if ($user){
          $char = 'abcdefghijklmnopqrstuvwxyz0123456789';

        $Pass = str_shuffle($char);
        $Password = substr($Pass, 8);
        $encoded = $encoder->encodePassword($user, $Password);

        $user->setPassword($encoded);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();


        $session->getFlashBag()->add('warning','Votre nouveau mot de passe est disponible sur botre boite mail. merci.');

        foreach ($session->getFlashBag()->get('warning', array()) as $message) {
        echo '<div class="alert alert-success">'.$message.'</div>';}

        /*$message = \Swift_Message::newInstance()
        ->setSubject($Password)
        ->setFrom('yacine.bouhsen@gmail.com')
        ->setTo($userEmail)
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'Emails/registration.html.twig'),
                    'text/html'
                    )
                    ;

    $this->get('mailer')->send($message);
    */
      }

        else {
          $session->getFlashBag()->add('error', 'Je suis désolé, indentifant incorrect!!!');
          foreach ($session->getFlashBag()->get('error', array()) as $message) {
    echo '<div class="alert alert-danger">'.$message.'</div>';}

        };

        }



        // else { }

      //}

      //$this->getDoctrine()->getManager()->flush();
      //return $this->redirectToRoute('home');

      return $this->render('arabianE/prestataire/resetpass.html.twig', [
          'form' => $form->createView(),
      ]);

    }

}
