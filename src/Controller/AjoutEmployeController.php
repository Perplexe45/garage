<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\AjoutEmployeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AjoutEmployeController extends AbstractController
{
    private $entityManager;
    
    #[Route('/ajout_employe', name: 'ajout_employe')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {

        // Création d'une instance de l'Employe
        $employe = new Employe();
        
        // Autres attributions de valeurs à l'employe... 
        $form = $this->createForm(AjoutEmployeType::class,$employe);
        /* $form = $this->createForm(AjoutEmployeType::class,$employe); */
        $form->handleRequest($request);//Ecoute de la requête
        if ($form->isSubmitted() && $form->isValid()) { //Le form est OK
            $employe = $form->getData(); //Recup de toutes les données du formulaire 'AjoutEmployeType'

            //Cryptage du mot de passe
            $password = $employe->getPassword(); //Récup du setter dans entité "Employe.php"
            $hashedPassword = $hasher->hashPassword($employe, $password);//le MDP est crypté
            $employe->setPassword($hashedPassword);//Réinjection du MDP dans '$employe'
            $employe->setIsAdmin(0); //Aucun employe est admin

            // Enregistrement de l'Employe
            $entityManager->persist($employe);//Prepare l'enreg
            $entityManager->flush();//Enreg les données dans entité 'Employe'
        } else {
            // Le formulaire n'est pas bien rempli

        }

         // Ajoutez une déclaration de retour pour tous les autres cas
         return $this->render('ajout_employe/index.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
        
       
