<?php

namespace App\Repository;

use App\Entity\AccessFDS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccessFDS>
 *
 * @method AccessFDS|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccessFDS|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccessFDS[]    findAll()
 * @method AccessFDS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessFDSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessFDS::class);
    }

//    /**
//     * @return AccessFDS[] Returns an array of AccessFDS objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AccessFDS
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
