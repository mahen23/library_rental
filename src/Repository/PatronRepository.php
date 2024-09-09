<?php

namespace App\Repository;

use App\Entity\Patron;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Patron>
 *
 * @method Patron|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patron|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patron[]    findAll()
 * @method Patron[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatronRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patron::class);
    }

//    /**
//     * @return Patron[] Returns an array of Patron objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Patron
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
