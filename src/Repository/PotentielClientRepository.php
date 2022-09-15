<?php

namespace App\Repository;

use App\Entity\PotentielClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PotentielClient>
 *
 * @method PotentielClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method PotentielClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method PotentielClient[]    findAll()
 * @method PotentielClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PotentielClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PotentielClient::class);
    }

    public function add(PotentielClient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PotentielClient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function filter(string $client)
    {
        $client .= '%';
        $qb = $this->createQueryBuilder('c')
                    ->where('c.firstname LIKE :firstname')
                    // ->orWhere('c.lastname LIKE :lastname')
                    // ->orWhere('c.opticien.lastnam LIKE :opticien')
                    // ->orWhere('c.phone LIKE :phone')
                    ->setParameter('firstname', $client)
                    // ->setParameter('lastname', $client)
                    // ->setParameter('opticien', $client)
                    // ->setParameter('phone', $client)
                    ->orderBy('c.firstname', 'ASC');

        $query = $qb->getQuery();
        dump($query->getParameters());

        return $query->execute();
    }
//    /**
//     * @return PotentielClient[] Returns an array of PotentielClient objects
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

//    public function findOneBySomeField($value): ?PotentielClient
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
