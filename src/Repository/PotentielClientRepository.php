<?php

namespace App\Repository;

use App\Entity\PotentielClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
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


    public function filter(string $filter)
    {
        $filter .= '%';
        $qb = $this->createQueryBuilder('c')
                    ->innerJoin('c.opticien', 'o')
                    ->where('c.firstname LIKE :firstname')
                    ->orWhere('c.lastname LIKE :lastname')
                    ->orWhere('o.lastname LIKE :opticien_lastname')
                    ->orWhere('o.firstname LIKE :opticien_firstname')
                    ->orWhere('c.phone LIKE :phone')
                    ->setParameter('firstname', $filter)
                    ->setParameter('lastname', $filter)
                    ->setParameter('opticien_lastname', $filter)
                    ->setParameter('opticien_firstname', $filter)
                    ->setParameter('phone', $filter)
                    ->orderBy('c.firstname', 'ASC');

        $query = $qb->getQuery();

        return $query->execute();
    }




    
    // /**
	//  * @return Paginator
	//  */
	// public function getOrders($firstResult,$maxResult){
	// 	$queryBuilder = $this->getOrderQueryBuilder();
		
	// 	// Add the first and max result limits
	// 	$queryBuilder->setFirstResult(1);
	// 	$queryBuilder->setMaxResults(5);
		
	// 	// Generate the Query
	// 	$query = $queryBuilder->getQuery();
		
	// 	// Generate the Paginator
	// 	$paginator = new Paginator($query, true);
	// 	return $paginator;
	// }

    // public function workWithOrder(){
	// 	// Get the first page of orders
	// 	$paginatedResult = $this->orderRepository->getOrders(1);
	// 	// get the total number of orders
	// 	$totalOrder = count($paginatedResult);
		
	// 	// Use the Paginator iterator
	// 	foreach ($paginatedResult as $order){
	// 		echo $order->getHeadline() . "\n";
	// 	}
	// }

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
