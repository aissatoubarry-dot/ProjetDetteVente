<?php

require_once dirname(__DIR__)."/Core/Database.php";
require_once dirname(__DIR__)."/Model/Repository/DetteRepository.php";

class DebtService{

    private $connexion;
    private $DetteRepository;

    public function __construct(){

        $this->connexion= Database :: getInstance() ->  getConnexion();
        $this->DetteRepository = new DetteRepository();

    }

    public function enregistrerRemboursement(int $dette_id, float $montant , string $modePaiement){

        try {

            $this->connexion->beginTransaction();

            $dette = $this->DetteRepository-> getDetteById( $dette_id);

            if (!$dette) {

                throw new Exception("Dette introuvable!");
            }

            if ($montant <= 0) {

                throw new Exception("Le montant doit etre superieur à 0!");
            }

            if ($montant > $dette['montant_restant']) {

                throw new Exception("Le montant est superieur au montant restant!");

            }

            $nouveauMontantRestant = $dette['montant_restant'] - $montant;
            $statut = "EN_COURS";

            if ($nouveauMontantRestant == 0) {

                $statut = "SOLDEE";

            }
            
            $sql = "INSERT INTO paiement
                    (dette_id, montant, date_paiement, mode_paiement)
                    VALUES
                    (:dette_id, :montant, CURRENT_DATE, :mode_paiement)";
            
            $prepare = $this->connexion->prepare($sql);
            $prepare->execute([
                'dette_id' => $dette_id,
                'montant' => $montant,
                'mode_paiement' => $modePaiement
            ]);


            $sql = " UPDATE dette SET montant_restant = :montant_restant, statut = :statut WHERE id = :id";
            $prepare = $this->connexion->prepare($sql);
            $prepare->execute([
                'montant_restant' =>  $nouveauMontantRestant,
                'statut' => $statut,
                'id' => $dette_id
            ]);

            $this->connexion->commit();

            return true;

        } catch (Exception $e) {

            if ($this->connexion->inTransaction()) {
                $this->connexion->rollBack();
            }

            throw $e;

        }

    }











}