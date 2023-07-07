<?php

namespace App\Controller;


use App\Form\SearchType;
use App\Repository\EquipementRepository;
use App\Repository\EquipementVoitureRepository;
use App\Repository\VoitureRepository;
use App\Model\Search;
use App\Repository\GallerieImageRepository;
use App\Repository\OptionsRepository;
use App\Repository\OptionVoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class GalleriePhotosController extends AbstractController
{
    #[Route('/gallerie/photos', name: 'app_gallerie_photos')]
    public function index(VoitureRepository $voitureRepository,
     GallerieImageRepository $gallerieImageRepository,
     EquipementRepository $equipementRepository,
     EquipementVoitureRepository $equipementVoitureRepository,
     OptionsRepository $optionsRepository,
     OptionVoitureRepository $optionVoitureRepository,
     Request $request,
     /* MarqueRepository $marqueRepository, */
     
     
     ): Response

    {
        $gallerieImages = $gallerieImageRepository->findAll();
        $equipementVoitures = $equipementVoitureRepository->findAll(); 
        $equipements = $equipementRepository->findAll();
        $options = $optionsRepository->findAll();
        $optionVoitures = $optionVoitureRepository->findAll();
        /* $marque = $marqueRepository->findAll(); */

        // Si recherche exécutée, $products contiendra les résultats filtrés
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);//Création du formulaire
        $form->handleRequest($request);//évènement du formulaire

        $filteredVoitures = [];
        $kmValue = null;
        $prixValue = null;
        $anneeValue = null;
        
        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->request->has('selectKm')) { //BTN submit KM
                $kmValue = $form->get('km')->getData();
                $filteredVoitures = $voitureRepository->findByCriteria($kmValue, null, null);
            } elseif ($request->request->has('selectPrix')) { //BTN submit prix
                $prixValue = $form->get('prix')->getData();
                $filteredVoitures = $voitureRepository->findByCriteria(null, $prixValue, null);
            } elseif ($request->request->has('selectAnnee')) { //BTN submit Année
                $anneeValue = $form->get('annee')->getData();
                $filteredVoitures = $voitureRepository->findByCriteria(null, null, $anneeValue);
            } elseif ($request->request->has('selectRAZ')) { //BTN submit RAZ
                return $this->redirectToRoute('app_gallerie_photos');
            }

        } else {
            // Aucun filtre spécifié, récupération de toutes les voitures
            $filteredVoitures = $voitureRepository->findAll();
        }
      
        return $this->render('gallerie_photos/index.html.twig', [
        'voitures' => $filteredVoitures,
        'gallerieImages' => $gallerieImages,
        'equipements' => $equipements,
        'equipementsVoiture' => $equipementVoitures,
        'options' => $options,
        'optionsVoiture' => $optionVoitures, 
        'form' => $form->createView()
        ]);
    }
}
