<?php

require_once __DIR__ . "/src/Controller/POSController.php";
require_once __DIR__ . "/src/Controller/DetteController.php";

$posController = new POSController();
$detteController = new DetteController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'create_order') {

        $posController->saveVente();

    } elseif (isset($_POST['action']) && $_POST['action'] === 'rembourser') {

        $detteController->rembourser();

    }

} else {

    if (isset($_GET['page']) && $_GET['page'] === 'dettes') {

        $detteController->afficherDettes();

    } else {

        $posController->afficherForm();

    }

}