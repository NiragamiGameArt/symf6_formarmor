<?php

namespace App\Repository;

use App\Entity\Inscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscription[]    findAll()
 * @method Inscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscription::class);
    }

    // /**
    //  * @return Inscription[] Returns an array of Inscription objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Inscription
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function listeInscriptionsParSession($id)
	{
		$queryBuilder = $this->createQueryBuilder('i')
        ->andwhere("i.session_formation_id = :id_session")
        ->setParameter('id_session', $id);
		$query = $queryBuilder->getQuery();
		return $query->getResult();
	}

    public function validationInscription($id)
	{
        /*
        $queryBuilder = $this->createQueryBuilder("i");
        $query = $queryBuilder->update('inscription', 'i')
            ->set('i.validee', ":valider")
            ->where('i.session_formation_id = :session_id')
            ->setParameter('valider', 1)
            ->setParameter('session_id', $id)
            ->getQuery();
        $result = $query->execute();
        */

        $queryBuilder = $this->createQueryBuilder("i");
        $queryBuilder
            ->update('App\Entity\Inscription', 'i')
            ->set('i.validee', 1)
            ->where('i.session_formation_id = :session_id')
            ->setParameter('session_id', $id);
        $query = $queryBuilder->getQuery();
        $query->execute();
    }
}

