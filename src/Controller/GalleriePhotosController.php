<?php

namespace App\Controller;

use App\Entity\Equipement;
use App\Entity\EquipementVoiture;
use App\Entity\Options;
use App\Entity\OptionVoiture;
use App\Repository\EquipementRepository;
use App\Repository\EquipementVoitureRepository;
use App\Repository\VoitureRepository;
use App\Repository\GallerieImageRepository;
use App\Repository\OptionsRepository;
use App\Repository\OptionVoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GalleriePhotosController extends AbstractController
{
    #[Route('/gallerie/photos', name: 'app_gallerie_photos')]
    public function index(VoitureRepository $voitureRepository,
     GallerieImageRepository $gallerieImageRepository,
     EquipementRepository $equipementRepository,
     EquipementVoitureRepository $equipementVoitureRepository,
     OptionsRepository $optionsRepository,
     OptionVoitureRepository $optionVoitureRepository
     ): Response

    {
        $voitures = $voitureRepository->findAll();
        $gallerieImages = $gallerieImageRepository->findAll();
        $equipementVoitures = $equipementVoitureRepository->findAll(); 
        $equipements = $equipementRepository->findAll();
        $options = $optionsRepository->findAll();
        $optionVoitures = $optionVoitureRepository->findAll();
      

        return $this->render('gallerie_photos/index.html.twig', [
        'voitures' => $voitures,
        'gallerieImages' => $gallerieImages,
        'equipements' => $equipements,
        'equipementsVoiture' => $equipementVoitures,
        'options' => $options,
        'optionsVoiture' => $optionVoitures,    
        ]);
    }
}
