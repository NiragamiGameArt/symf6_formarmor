<?php

namespace App\Repository;

use App\Entity\Session_formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SessionFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SessionFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SessionFormation[]    findAll()
 * @method SessionFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Session_formationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session_formation::class);
    }

    // /**
    //  * @return Session_formation[] Returns an array of Session_formation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Session_formation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
	
	public function listeSessions() // Liste toutes les sessions avec pagination
	{
		$queryBuilder = $this->createQueryBuilder('s');

		// On n'ajoute pas de critère ou tri particulier ici car on veut toutes les sessions, la construction
		// de notre requête est donc finie

		// On récupère la Query à partir du QueryBuilder
		$query = $queryBuilder->getQuery();

		// On gère ensuite la pagination grace au service KNPaginator
		return $query->getResult();
	}
	public function suppSession($id) // Suppression de la session d'identifiant $id
	{
		$qb = $this->createQueryBuilder('i');
		$query = $qb->delete('App\Entity\Inscription', 'i')
		  ->where('i.session_formation_id = :id')
		  ->setParameter('id', $id)
		  ->getQuery()
          ->getResult();

        $qb = $this->createQueryBuilder('s');
		$query = $qb->delete('App\Entity\Session_formation', 's')
		  ->where('s.id = :id')
		  ->setParameter('id', $id);
		
		$qb = $qb->getQuery()->getResult();


        return $qb;
	}

    public function listeSessionsNonValidees() // Liste toutes les sessions avec pagination
	{

        return $this->createQueryBuilder('s')
            //->select("s, DATE_ADD(:date_actuelle, 4, 'day') AS dateCalculee")
            //->from("App\Entity\Session_formation", "s")
            ->andwhere("s.close != :num_close")
            ->andwhere("(s.nbPlaces = s.nbInscrits) or (s.dateDebut >= :date_actuelle)")
            ->orderBy('s.dateDebut', 'ASC')
            ->setParameter('num_close', 1)
            ->setParameter('date_actuelle', date("Y-m-d"))
            ->getQuery()
            ->getResult();
	}

    public function validationSession($id)
	{
        /*
        $queryBuilder = $this->createQueryBuilder("s");
        $query = $queryBuilder->update('Session_formation', 's')
            ->set('s.close', ":valider")
            ->where('s.id= :session_id')
            ->setParameter('valider', 1)
            ->setParameter('session_id', $id)
            ->getQuery();
        $result = $query->execute();
        */

        $queryBuilder = $this->createQueryBuilder("s");
        $queryBuilder
            ->update('App\Entity\Session_formation', 's')
            ->set('s.close', 1)
            ->where("s.id = :session_id")
            ->setParameter('session_id', $id);
        $query = $queryBuilder->getQuery();
        $query->execute();
    }
}
