<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController{

    /**
     * @Route("/", name="app_home")
     */

    public function view(){
        return $this->render('/index.html.twig');
    }
}