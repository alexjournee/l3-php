<?php


namespace App\Controller;

class CatalogController extends AbstractController
{

    public function view()
    {
        $list_product = ['eh', 'merce', 'Damien'];
        echo $this->render('catalogue/view.phtml', ['products' => $list_product]);
    }
}