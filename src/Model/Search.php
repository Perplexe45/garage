<?php
namespace App\Model;

use App\Entity\Voiture;
use Doctrine\Common\Collections\Collection;

/**
 * Permet de créer un formulaire de recherche grâce à un SearchType
 */
class Search
{
    /**
     * @var integer|null
     */
    public $km = null;


     /**
     * @var integer|null
     */
    public $prix = null;

     /**
     * @var integer|null
     */
    public $annee= null;

    public function getKmChoices()
    {
        return [
            '< 20000 km' => 20000,
            '< 50000 km' => 50000,
            '< 75000 km' => 75000,
            '< 200000 km' => 200000,
        ];
    }

    public function getPricesChoices()
    {
        return [
            '< 3000 €' => 300000,
            '< 5000 €' => 500000,
            '< 10000 €' => 1000000,
            '< 30000 €' => 3000000,
        ];
    }

    public function getYearsChoices()
    {
        $currentYear = [];
        $currentYear = date('Y');
        return [
            '< 2 ans' => intval($currentYear - 2),
            '< 5 ans' => intval($currentYear - 5),
            '< 10 ans' => intval($currentYear - 10),
            '< 20 ans' => intval($currentYear - 20),
            '< 30 ans' => intval($currentYear - 30),
        ];
        
    }
}
