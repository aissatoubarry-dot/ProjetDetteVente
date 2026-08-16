<?php

require_once dirname(__DIR__)."/Model/Repository/DetteRepository.php";
require_once dirname(__DIR__)."/Model/Repository/ProduitRepository.php";
require_once dirname(__DIR__)."/Model/Repository/ClientRepository.php";
require_once dirname(__DIR__)."/Service/DebtService.php";

class DetteController
{
    private $DetteRepository;
    private $ProduitRepository;
    private $ClientRepository;
    private $DebtService;

    public function __construct()
    {
        $this->DetteRepository = new DetteRepository();
        $this->ProduitRepository = new ProduitRepository();
        $this->ClientRepository = new ClientRepository();
        $this->DebtService = new DebtService();
    }

    public function afficherDettes()
    {
        $dettes = $this->DetteRepository->getAllDettes();
        $clients = $this->ClientRepository->getAllClients();
        $produits = $this->ProduitRepository->getAllProduits();

        require_once dirname(__DIR__)."/View/pos/index.php";
    }

    public function rembourser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $dette_id = (int) $_POST['dette_id'];

            $montant = (float) $_POST['montant'];

            $modePaiement = $_POST['modePaiement'];

            try {

                $this->DebtService->enregistrerRemboursement(
                    $dette_id,
                    $montant,
                    $modePaiement
                );

                $message = "Remboursement effectué avec succès!";

            } catch (Exception $e) {

                $message = $e->getMessage();

            }

            $dettes = $this->DetteRepository->getAllDettes();
            $clients = $this->ClientRepository->getAllClients();
            $produits = $this->ProduitRepository->getAllProduits();

            require_once dirname(__DIR__)."/View/pos/index.php";
        }
    }
}