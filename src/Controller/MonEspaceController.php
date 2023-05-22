<?php

namespace App\Controller;
use App\Entity\Session_formation;
use App\Entity\Inscription;

use App\Repository\Session_formationRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class MonEspaceController extends AbstractController
{
    /**
     * @Route("/mon/espace", name="monEspace")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $this->doctrine=$doctrine;
        $rep = $doctrine->getRepository(Session_formation::class);
        $lesSessions = $rep->listeSessionsNonValidees();
        return $this->render('mon_espace/index.html.twig', Array('lesSessions' => $lesSessions));
    }


    /**
     * @Route("/mon/espace/details/{id}", name="monEspaceDetail")
     */
	// Affichage du formulaire de modification d'un client 
	public function detailsSession(ManagerRegistry $doctrine, $id)
    {
		$em = $this->doctrine=$doctrine;
		$rep = $em->getRepository(Inscription::class);
		$lesInscriptions = $rep->listeInscriptionsParSession($id);
        return $this->render('mon_espace/details.html.twig', Array('lesInscriptions' => $lesInscriptions, 'id_session' => $id));
	}

    /**
     * @Route("/mon/espace/annuler_session/{id}", name="annuler_session")
     */
	public function annulerSession(ManagerRegistry $doctrine,$id) 
    {
		$em = $this->doctrine=$doctrine;
		$rep1 = $em->getRepository(Session_formation::class);
		$rep1->suppSession($id);
        $this->doctrine=$doctrine;
        $rep = $doctrine->getRepository(Session_formation::class);
        $lesSessions = $rep->listeSessionsNonValidees();
        return $this->render('mon_espace/index.html.twig', Array('lesSessions' => $lesSessions));
    }

    /**
     * @Route("/mon/espace/valider_session/{id}", name="valider_session")
     */
	public function validerSession(ManagerRegistry $doctrine, $id) 
    {
        
		$em = $this->doctrine=$doctrine;
		$rep1 = $em->getRepository(Inscription::class);
		$rep1->validationInscription($id);

        $rep2 = $em->getRepository(Session_formation::class);
        $rep2->validationSession($id);

        $lesSessions = $rep2->listeSessionsNonValidees();

        return $this->render('mon_espace/index.html.twig', Array('lesSessions' => $lesSessions, 'id_session' => $id));
        
    }

}
