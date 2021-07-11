<?php


namespace App\Controller;


use App\Repository\MatchsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Matchs;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="app_compte")
     */
    public function compte(MatchsRepository $matchsRepository){
        $pari = $matchsRepository->findBy(['id_user' => $this->getUser()->getId()]);
        $listeMatches = file_get_contents('http://mathys-pomier.fr:4000/euro');
        $listeMatches = json_decode($listeMatches, true);

        $point = 0;

        foreach ( $listeMatches as $l ){
            foreach ($pari as $p){
                if(isset($l['scores'])) {
                    if ($l['scores']['tireaubut'] == true) {
                        $winner = $p->getScoreDomicile() > $p->getScoreExterieur() ? "domicile" : "exterieur";
                        if ($l['scores']['winner'] == $winner) {
                            $point += 1;
                        }
                    } else {
                        $winner = $p->getScoreDomicile() > $p->getScoreExterieur() ? "domicile" : "exterieur";
                        $winner2 = $l['scores']['domicile'] > $l['scores']['exterieur'] ? "domicile" : "exterieur";
                        if ($p->getScoreDomicile() == $l['scores']['domicile'] && $p->getScoreExterieur() == $l['scores']['exterieur']) {
                            $point += 3;
                        } elseif ($winner == $winner2) {
                            $point = 1;
                        }
                    }
                }

            }
        }

        return $this->render('compte/compte.html.twig', [
            'paris' => $pari,
            'point' => $point,
            'matchs' => $listeMatches]);

    }
}