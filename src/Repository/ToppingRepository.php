<?php

namespace App\Repository;

use App\Entity\Topping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Topping|null find($id, $lockMode = null, $lockVersion = null)
 * @method Topping|null findOneBy(array $criteria, array $orderBy = null)
 * @method Topping[]    findAll()
 * @method Topping[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToppingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Topping::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Topping $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Topping $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Topping[] Returns an array of Topping objects
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

    /*
    public function findOneBySomeField($value): ?Topping
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getAllTopping(){

        return $this->createQueryBuilder('t')
            ->select('t.name')
            ->getQuery()->getResult();
    }
}
