<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController{

    public function view(){
        return $this->render('index.html.twig');
    }
}