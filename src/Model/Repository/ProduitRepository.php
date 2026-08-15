<?php

require_once dirname(__DIR__)."/../Core/Database.php";
require_once dirname(__DIR__)."/Entity/Produit.php";

class ProduitRepository{

    private $connexion;

    public function __construct(){
        $this->connexion = Database :: getInstance() -> getConnexion();
    }

    public function getAllProduits(){

        $sql = "SELECT * FROM produit";

        $prepare = $this->connexion -> prepare($sql);
        $prepare->execute();

        $produits = $prepare -> fetchAll(PDO::FETCH_CLASS , "Produit");

        return $produits;

    }


    public function getProduitById(int $id){

        $sql = "SELECT * FROM produit WHERE id = :id";

        $prepare = $this->connexion -> prepare($sql);
        $prepare->execute(['id' => $id]);

        $produit = $prepare -> fetch(PDO::FETCH_ASSOC);

        if (!$produit) {
            return null;
        }

        return new Produit(
            $produit['nom'],
            $produit['prix_achat'],
            $produit['prix_vente'],
            $produit['quantite_stock']
        );
    }

}