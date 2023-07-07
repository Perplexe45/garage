<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Contact;
use App\Entity\Employe;
use App\Entity\Evocation;
use App\Entity\Service;
use App\Entity\OptionVoiture;
use App\Repository\VoitureRepository;
use App\Repository\InfoSpecialeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{
    private $entityManager;
    private $infoSpecialRepository;

    public function __construct(EntityManagerInterface $entityManager, InfoSpecialeRepository $infoSpecialeRepository)
    {
        $this->entityManager = $entityManager;
        $this->infoSpecialRepository = $infoSpecialeRepository;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        // Récupérer les témoignages depuis l'entité témoignage
        $temoignages = $this->entityManager->getRepository(Avis::class)->findAll();
        $OptionVoiture = $this->entityManager->getRepository(OptionVoiture::class)->find(2);
        $service = $this->entityManager->getRepository(Service::class)->findAll();
        $evocation = $this->entityManager->getRepository(Evocation::class);
        $info = $this->infoSpecialRepository->findAll();
        
        return $this->render('home.html.twig',[
            'temoignages'=>$temoignages,
            'OptionVoiture'=>$OptionVoiture,
            'services'=>$service,
            'evocations'=>$evocation,   
            'infoSpecial' => $info
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

    public function contactClients(RequestStack $requestStack, EntityManagerInterface $entityManager, VoitureRepository $voitureRepository){
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

        ///////////Recherche de l'identif de la voiture dans l'entité Voiture////////////
        $valeurSelect = $request->request->get('selectId');//Recup le nom de la ligne du select du form
        // Utiliser le repository pour trouver l'objet correspondant
        $identif = $voitureRepository->findOneBy([
            'id' => $valeurSelect, // Condition de recherche par ID 
        ]);
        $contact->setIDvoiture($identif);

        $entityManager->persist($contact);
        $entityManager->flush();
       
        
        // Redirection de l'utilisateur vers la page d'accueil
        return $this->redirectToRoute('home');
    }
    
}
