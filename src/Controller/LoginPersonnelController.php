<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;

class LoginPersonnelController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_connexion')]
    public function login(AuthenticationUtils $authenticationUtils, EntityManagerInterface $employe): Response
    {
        $employe = new Employe;

         if ($this->getUser  ()) {
            if ($employe->isIsAdmin()){
                return $this->redirectToRoute('app_admin');
           } else {
            return $this->redirectToRoute('app_employe');
           }
         }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
         return $this->render('security/loginEmploye.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/deconnexion', name: 'app_deconnexion')]
    public function logout(): RedirectResponse
    {
        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->redirectToRoute('home');
    }
}
