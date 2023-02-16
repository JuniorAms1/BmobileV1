<?php

namespace App\Repository;

use App\Entity\EnseigneDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EnseigneDetails>
 *
 * @method EnseigneDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnseigneDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnseigneDetails[]    findAll()
 * @method EnseigneDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnseigneDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnseigneDetails::class);
    }

    public function save(EnseigneDetails $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EnseigneDetails $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EnseigneDetails[] Returns an array of EnseigneDetails objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EnseigneDetails
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
