<?php

require_once dirname(__DIR__)."/Core/Database.php";
require_once dirname(__DIR__)."/Model/Repository/ProduitRepository.php";
require_once dirname(__DIR__)."/Model/Repository/ClientRepository.php";
require_once dirname(__DIR__)."/Service/VenteService.php";

class POSController
{
    private $ProduitRepository;
    private $ClientRepository;
    private $VenteService;

    public function __construct()
    {
        $this->ProduitRepository = new ProduitRepository();
        $this->ClientRepository = new ClientRepository();
        $this->VenteService = new VenteService();
    }

    public function afficherForm()
    {
        $clients = $this->ClientRepository->getAllClients();
        $produits = $this->ProduitRepository->getAllProduits();

        require_once dirname(__DIR__)."/View/pos/index.php";
    }

    public function saveVente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            

            $client_id = (int) $_POST['client_id'];

            $lignesCommande = [];

            foreach ($_POST['product_ids'] as $index => $produit_id) {

                $lignesCommande[] = [

                    'produit_id' => (int) $produit_id,
                    'quantite' => (int) $_POST['product_qtys'][$index]

                ];
            }

            $modeReglement = $_POST['mode_reglement'];

            try {

                $commandeId = $this->VenteService->enregistrerCommande(
                    $client_id,
                    $lignesCommande,
                    $modeReglement
                );

                $message = "Vente enregistrée avec succès. Commande : " . $commandeId;

            } catch (Exception $e) {

                $message = $e->getMessage();

            }

            $clients = $this->ClientRepository->getAllClients();
            $produits = $this->ProduitRepository->getAllProduits();

            require_once dirname(__DIR__)."/View/pos/index.php";
        }
    }
}