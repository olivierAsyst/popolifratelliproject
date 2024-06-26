<?php

namespace App\Repository;

use App\Entity\StudentBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StudentBook>
 *
 * @method StudentBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentBook[]    findAll()
 * @method StudentBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentBookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentBook::class);
    }

//    /**
//     * @return StudentBook[] Returns an array of StudentBook objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StudentBook
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
