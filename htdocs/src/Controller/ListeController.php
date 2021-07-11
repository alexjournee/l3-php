<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Matchs;


class ListeController extends AbstractController
{
    /**
     * @Route("/liste", name="app_liste")
     */

    public function view(){
        $listeMatchs = file_get_contents('http://mathys-pomier.fr:4000/euro');
        $listeMatchs = json_decode($listeMatchs, true);
        #var_dump($listeMatchs);
        return $this->render('/liste/liste.html.twig', ['listeMatchs' => $listeMatchs]);
    }

    /**
     * @Route("/parier", name="parier", methods={"POST"})
     */
    public function parier()
    {
        $manager = $this->getDoctrine()->getManager();

        $pari = new Matchs();
        $pari->setIdUser($this->getUser()->getId());
        $pari->setIdMatch($_POST['id_match']);
        $pari->setScoreDomicile($_POST['score_domicile']);
        $pari->setScoreExterieur($_POST['score_exterieur']);

        $manager->persist($pari);
        $manager->flush();

        return $this->redirectToRoute("liste");
    }

}