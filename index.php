<?php

require_once __DIR__."/src/Controller/POSController.php";

$controller = new POSController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller->saveVente();

} else {

    $controller->afficherForm();
}