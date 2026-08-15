<?php

require_once dirname(__DIR__)."/Core/Database.php";
require_once dirname(__DIR__)."/Model/Repository/ProduitRepository.php";
require_once dirname(__DIR__)."/Model/Repository/ClientRepository.php";

class VenteService {

    private $connexion;
    private $ProduitRepository;
    private $ClientRepository;

    public function __construct(){

        $this->connexion = Database :: getInstance() -> getConnexion();
        $this->ProduitRepository = new ProduitRepository();
        $this->ClientRepository  = new ClientRepository();

    }

    public function enregistrerCommande(int $client_id , array $lignesCommande , string $modeReglement){

        try {
            
            $this->connexion->beginTransaction();

            $client = $this->ClientRepository->getClientById($client_id);
            if (!$client) {
                throw new Exception("client introuvable");
            }


            $total = 0;
            foreach ($lignesCommande as $ligne) {

                $produit = $this->ProduitRepository->getProduitById( $ligne['produit_id']);
                if (!$produit) {
                    throw new Exception("Produit introuvable");
                }
                if ($ligne['quantite'] <= 0) {
                    throw new Exception("Quantité doit etre superieure à 0");
                }

                if ($produit->getQuantiteStock() < $ligne['quantite']) {
                    throw new Exception("Stock insuffisant");
                }

                $total += $produit->getPrixVente() * $ligne['quantite'];

            }

            if ($modeReglement=='CREDIT') {

                $sql = "SELECT COALESCE(SUM(d.montant_restant), 0)
                        FROM dette d
                        INNER JOIN commande c ON c.id = d.commande_id
                        WHERE c.client_id = :client_id
                        AND d.statut != 'SOLDEE'";

                $prepare = $this->connexion->prepare($sql) ;
                $prepare->execute(['client_id'=> $client_id]) ;  

                $creditUtilise = $prepare->fetchColumn();  
                $creditDisponible = $client->getLimiteCredit() - $creditUtilise;

                if ($total >   $creditDisponible ) {
                    throw new Exception("La limite de crédit du client est dépassée");
                }

            }

            $sql = "INSERT INTO commande
                    (client_id, montant_total, mode_reglement)
                    VALUES
                    (:client_id, :montant_total, :mode_reglement)
                    RETURNING id";

            $prepare = $this->connexion->prepare($sql);

            $prepare->execute([
                "client_id" => $client_id,
                "montant_total" => $total,
                "mode_reglement" => $modeReglement
            ]);

            $commandeId = $prepare->fetchColumn();

            foreach ($lignesCommande as $ligne) {

                $produit = $this->ProduitRepository->getProduitById($ligne["produit_id"]);

                $sql = "INSERT INTO ligne_commande
                        (commande_id, produit_id, quantite, prix_unitaire)
                        VALUES
                        (:commande_id, :produit_id, :quantite, :prix_unitaire)";

                $prepare = $this->connexion->prepare($sql);

                $prepare->execute([
                    "commande_id" => $commandeId,
                    "produit_id" => $ligne["produit_id"],
                    "quantite" => $ligne["quantite"],
                    "prix_unitaire" => $produit->getPrixVente()
                ]);



                $sql = "UPDATE produit
                        SET quantite_stock = quantite_stock - :quantite
                        WHERE id = :produit_id";

                $prepare = $this->connexion->prepare($sql);

                $prepare->execute([
                    "quantite" => $ligne["quantite"],
                    "produit_id" => $ligne["produit_id"]
                ]);

            } 

            if ($modeReglement === "CREDIT") {

                $sql = "INSERT INTO dette
                        (commande_id, montant_initial, montant_restant, statut)
                        VALUES
                        (:commande_id, :montant_initial, :montant_restant, :statut)";

                $prepare = $this->connexion->prepare($sql);

                $prepare->execute([
                    "commande_id" => $commandeId,
                    "montant_initial" => $total,
                    "montant_restant" => $total,
                    "statut" => "EN_COURS"
                ]);
            }

            $this->connexion->commit();

            return $commandeId;


        } catch (Exception $e) {

            if ($this->connexion->inTransaction()) {
                $this->connexion->rollBack();
            }

            throw $e;

        }



    }


















}