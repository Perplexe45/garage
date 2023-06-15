<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Employe;
use App\Entity\Contact;
use app\Form\ContactFormType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        // Récupérer les témoignages depuis l'entité témoignage
        $temoignages = $this->entityManager->getRepository(Avis::class)->findAll();
        return $this->render('home.html.twig',[
            'temoignages' => $temoignages
        ]);
    }

    public function traitementTemoignage(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $request = $requestStack->getCurrentRequest();//recup nom des champs de inputs dans Twig
        $nom = $request->request->get('nom');
        $commentaire = $request->request->get('commentaire');
        $note = $request->request->get('note');
        
        // Créez une instance de l'entité Temoignage
        $avis = new Avis();
        $avis->setCommentaire($commentaire);
        $avis->setNote($note);
        $avis->setAcceptation(0);
        $avis->setNom($nom);
       

        //Par défaut setidentifiant =1 sinon ereur 
        $avis->setIDemploye($entityManager->getRepository(Employe::class)->find(1));
        
        // Persist de l'entité en utilisant l'EntityManager
        $entityManager->persist($avis);
        $entityManager->flush();

        $this->addFlash('notice', 'Merci de votre avis, avant d\'être publié,celui sera soumis au modérateur du site.');

        // Redirection de l'utilisateur vers la page d'accueil
        return $this->redirectToRoute('home');
    }

    public function contactClients(RequestStack $requestStack, EntityManagerInterface $entityManager){
        $request = $requestStack->getCurrentRequest();//recup nom des champs de inputs dans Twig
        $nom = $request->request->get('name');
        $prenom = $request->request->get('prenom');
        $email = $request->request->get('email');
        $phone = $request->request->get('phone');
        $message = $request->request->get('message');

        $contact = new Contact;
        $contact->setNom($nom);
        $contact->setPrenom($prenom);
        $contact->setEmail($email);
        $contact->setTelephone($phone);
        $contact->setMessage($message);

        $contact->setIDemploye($entityManager->getRepository(Employe::class)->find(1));

        // Persist de l'entité en utilisant l'EntityManager
        $entityManager->persist($contact);
        $entityManager->flush();
        $this->addFlash('notice', 'Merci de votre contact, nous vous répondrons dans les plus brefs délais');
        // Redirection de l'utilisateur vers la page d'accueil
        return $this->redirectToRoute('home');
    }
   
   
 
 
    /*  public function formulaireClients(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer les données dans la table 'contact'
            $entityManager->persist($contact);
            $entityManager->flush();

            // Afficher un message de succès
            $this->addFlash('success', 'Le message a été envoyé.');
      
        }
        
        // Retourner la réponse avec le formulaire créé
         return $this->redirectToRoute('home', [
            'form' => $form->createView()
        ]);
    } */

    
}
