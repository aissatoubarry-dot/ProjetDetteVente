<?php
require_once dirname(__DIR__)."/../Core/Database.php";

class DetteRepository{

    private $connexion;

    public function __construct(){
        $this->connexion = Database::getInstance()->getConnexion();
    }

    public function getAllDettes(){

       $sql = "SELECT  d.id, d.commande_id, d.montant_initial, d.montant_restant, d.statut, c.client_id, c.date_commande, cl.nom, cl.prenom, cl.telephone,
        COALESCE(SUM(p.montant), 0) AS montant_paye
        FROM dette d
        INNER JOIN commande c ON c.id = d.commande_id
        INNER JOIN client cl ON cl.id = c.client_id
        LEFT JOIN paiement p ON p.dette_id = d.id
        GROUP BY
            d.id, d.commande_id, d.montant_initial, d.montant_restant, d.statut, c.client_id, c.date_commande, cl.nom, cl.prenom, cl.telephone
        ORDER BY d.id DESC";

        $prepare = $this->connexion->prepare($sql);
        $prepare->execute();

        $dettes = $prepare->fetchAll(PDO::FETCH_ASSOC);

        return $dettes;
    }

    public function getDetteById(int $id){

        $sql = "SELECT d.id,   d.commande_id,  d.montant_initial,  d.montant_restant,  d.statut, c.client_id, cl.nom, cl.prenom,  cl.telephone
                FROM dette d
                INNER JOIN commande c ON c.id = d.commande_id
                INNER JOIN client cl ON cl.id = c.client_id
                WHERE d.id = :id";

        $prepare = $this->connexion->prepare($sql);
        $prepare->execute([
            'id' => $id
        ]);

        $dette =  $prepare->fetch(PDO::FETCH_ASSOC);

        return $dette;
    }
}