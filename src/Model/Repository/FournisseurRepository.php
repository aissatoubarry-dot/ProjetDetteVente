<?php

require_once dirname(__DIR__)."/../Core/Database.php";
require_once dirname(__DIR__)."/Entity/Fournisseur.php";

class FournisseurRepository{

    private $connexion;

    public function __construct(){
        $this->connexion = Database :: getInstance() -> getConnexion();
    }

    public function getAllFournisseurs(){

        $sql = "SELECT * FROM fournisseur";

        $prepare = $this->connexion -> prepare($sql);
        $prepare->execute();

        $fournisseurs = $prepare -> fetchAll(PDO::FETCH_CLASS, "Fournisseur");

        return $fournisseurs;
    }

    public function getFournisseurById(int $id){

        $sql = "SELECT * FROM fournisseur WHERE id = :id";

        $prepare = $this->connexion -> prepare($sql);
        $prepare->execute(['id' => $id]);

        $fournisseur = $prepare -> fetch(PDO::FETCH_CLASS, "Fournisseur");

        return $fournisseur;
    }
}