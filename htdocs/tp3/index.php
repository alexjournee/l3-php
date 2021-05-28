<?php

use App\Controller\HomeController;
use App\Entity\Product;

require_once "Autoload.php";
Autoload::register();

$product = new Product();
$controller = new HomeController();

var_dump($product);

echo ('OK');

$routeur = newRouteur();

