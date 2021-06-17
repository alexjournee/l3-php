<?php


namespace App\Controller;

class CatalogController extends AbstractController
{

    public function view()
    {
        $list_product = ['Damien', 'le', 'sang'];
        echo $this->render('catalogue/view.phtml', ['products' => $list_product]);
    }
}