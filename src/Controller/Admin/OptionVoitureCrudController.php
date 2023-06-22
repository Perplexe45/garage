<?php

namespace App\Controller\Admin;

use App\Entity\EquipementVoiture;
use App\Entity\OptionVoiture;
use App\Repository\OptionsRepository;
use App\Repository\EquipementRepository;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class OptionVoitureCrudController extends AbstractCrudController
{
    #[Route('/admin/options_voiture', name: 'options_voiture')]
    public function optionsVoiture(
        VoitureRepository $voitureRepository,
        OptionsRepository $optionRepository,
        EquipementRepository $equipementRepository,
        EntityManagerInterface $entityManager,
        Request $request // Ajoutez la classe Request ici
    ): Response {
        $voitures = $voitureRepository->findBy(['vendu' => false]);
        $options = $optionRepository->findAll();
        $equipements = $equipementRepository->findAll();

        // Récupérer les valeurs sélectionnées depuis la requête
        $selectedOptions = $request->request->get('selectedOptions'); 
        $selectedEquipements = $request->request->get('selectedEquipements'); 
        
        
        // Traiter les valeurs sélectionnées et les affecter aux entités correspondantes
        if (is_iterable($selectedOptions)) {
            foreach ($selectedOptions as $optionId) {
                $option = $optionRepository->find($optionId);
                if ($option) {
                    $optionVoiture = new OptionVoiture();
                    $optionVoiture->setIDoptions($option);
                    $entityManager->persist($optionVoiture);
                }
            }     
        }
        
        if (is_iterable($selectedEquipements)) {
            foreach ($selectedEquipements as $equipementId) {
                $equipement = $equipementRepository->find($equipementId);
                if ($equipement) {
                    $equipementVoiture = new EquipementVoiture();
                    $equipementVoiture->setIDequipement($equipement);
                    $entityManager->persist($equipementVoiture);
                }  
            }
        }

        
        $entityManager->flush(); // Enregistrer les entités persistées

        return $this->render('admin/options_voiture.html.twig', [
            'voitures' => $voitures,
            'options' => $options,
            'equipements' => $equipements,
        ]);
    }

    public static function getEntityFqcn(): string
    {
        return OptionVoiture::class;
    }
}