<?php

namespace App\Repository;

use App\Entity\Published;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Published>
 *
 * @method Published|null find($id, $lockMode = null, $lockVersion = null)
 * @method Published|null findOneBy(array $criteria, array $orderBy = null)
 * @method Published[]    findAll()
 * @method Published[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublishedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Published::class);
    }

//    /**
//     * @return Published[] Returns an array of Published objects
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

//    public function findOneBySomeField($value): ?Published
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
