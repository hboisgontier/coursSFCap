<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{

    private $em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, Serie::class);
        $this->em = $em;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Serie $entity, bool $flush = true): void
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
    public function remove(Serie $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findGoodSeries() {
        // QueryBuilder
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere('s.vote >= 8')
            ->addOrderBy('s.vote', 'DESC');
        $query = $qb->getQuery();
        // DQL
        /*
        $dql = 'SELECT s
                FROM App\Entity\Serie s
                WHERE s.vote >= 8
                ORDER BY s.vote DESC';
        $query = $this->em->createQuery($dql);
        */
        return $query->getResult();
    }

    public function findWithSeasons($pageNumber = 0, $limit = 7) {
        $qb = $this->createQueryBuilder('serie')
            ->join('serie.seasons', 'seasons')
            ->addSelect('seasons')
            ->setMaxResults($limit)
            ->setFirstResult($pageNumber * $limit)
        ;
        $query = $qb->getQuery();
        return new Paginator($query);
    }
}
