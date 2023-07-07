<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\HoraireRepository;



class BaseController extends AbstractController
{
   private $horaireRepository;

    public function __construct(HoraireRepository $horaireRepository )
    {
        $this->horaireRepository = $horaireRepository;  
    }


    public function renderFooter(): Response
    {
        $horaires = $this->horaireRepository->findAll();

        return $this->render('security/_footer.html.twig', [
            'horaires' => $horaires, 
        ]);
    }
}
