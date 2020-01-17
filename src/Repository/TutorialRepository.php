<?php

namespace App\Repository;

use App\Entity\Tutorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tutorial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tutorial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tutorial[]    findAll()
 * @method Tutorial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutorialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tutorial::class);
    }

    // /**
    //  * @return Tutorial[] Returns an array of Tutorial objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function findOneNextTuto($value): ?Tutorial
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.order_menu > :val')
            ->setMaxResults(1)
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    } 
       public function findOnePrevTuto($value): ?Tutorial
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.order_menu < :val')
            ->setMaxResults(1)
            ->orderBy('t.order_menu', 'DESC')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
