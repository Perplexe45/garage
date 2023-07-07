<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voiture>
 *
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    public function save(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByCriteria($kmValue, $prixValue, $anneeValue): array
    {
        $queryBuilder = $this->createQueryBuilder('v');
    
        if ($kmValue !== null) {
            $queryBuilder
                ->andWhere('v.kilometre < :kmValue')
                ->setParameter('kmValue', $kmValue)
                ->OrderBy('v.kilometre', 'ASC');
        }

        if ($prixValue !== null) {
            $queryBuilder
                ->andWhere('v.prix < :prixValue')
                ->setParameter('prixValue', $prixValue)
                ->OrderBy('v.prix', 'ASC');           
        }
    
        if ($anneeValue !== null) {
            $queryBuilder
                ->andWhere('v.circulation > :anneeValue')
                ->setParameter('anneeValue', $anneeValue)
                ->OrderBy('v.circulation', 'DESC');  
        }
    
        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /* $test = $queryBuilder-> getQuery() ->getResult();

    var_dump($kmValue);
    var_dump($prixValue);
    var_dump($anneeValue);

    dd($test); */


//    /**
//     * @return Voiture[] Returns an array of Voiture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Voiture
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
