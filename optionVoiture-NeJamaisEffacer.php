<?php
namespace App\Controller\Admin;

use App\Entity\EquipementVoiture;
use App\Entity\OptionVoiture;
use App\Repository\OptionsRepository;
use App\Repository\EquipementRepository;
use App\Repository\EquipementVoitureRepository;
use App\Repository\OptionVoitureRepository;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class OptionVoitureCrudController extends AbstractCrudController
{
    #[Route('/admin/options_voiture', name: 'options_voiture_submit')]
    public function optionsVoiture(
        VoitureRepository $voitureRepository,
        OptionsRepository $optionRepository,
        OptionVoitureRepository $optionVoitureRepository,
        EquipementRepository $equipementRepository,
        EquipementVoitureRepository $equipementVoitureRepository,
        EntityManagerInterface $entityManager,
        Request $request 
    ): Response {
        $voitures = $voitureRepository->findBy(['vendu' => false]);
        $options = $optionRepository->findAll();
        $equipements = $equipementRepository->findAll();
        $selectedOptions = $request->request->get('selectedOptions');
        $selectedEquipements = $request->request->get('selectedEquipements');


        // Récupérer les valeurs de selectedOptions et selectedEquipements depuis la requête HTTP
        $selectedOptions = explode(',', $selectedOptions);
        $selectedEquipements = explode(',', $selectedEquipements);
        /* dd($selectedOptions); */
        
        // Enregistrement des lignes sélectionnées dans les entités "OptionVoiture" et "EquipementVoiture"
        foreach ($selectedOptions as $optionId) {
            $option = $optionRepository->find($optionId);
            if ($option) {
                $optionVoiture = new OptionVoiture();
                $optionVoiture->setIDoptions($option);
                $entityManager->persist($optionVoiture);
            }
        }

        foreach ($selectedEquipements as $equipementId) {
            $equipement = $equipementRepository->find($equipementId);
            if ($equipement) {
                $equipementVoiture = new EquipementVoiture();
                $equipementVoiture->setIDequipement($equipement);
                $entityManager->persist($equipementVoiture);
            }
        }
        $entityManager->flush(); // Enregistrer en BD

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
