<?php

class Produit
{
    private $id;
    private $nom;
    private $prixAchat;
    private $prixVente;
    private $quantiteStock;

    public function __construct($nom, $prixAchat, $prixVente, $quantiteStock = 0)
    {
        $this->nom = $nom;
        $this->prixAchat = $prixAchat;
        $this->prixVente = $prixVente;
        $this->quantiteStock = $quantiteStock;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    public function getPrixVente()
    {
        return $this->prixVente;
    }

    public function getQuantiteStock()
    {
        return $this->quantiteStock;
    }

    public function augmenterStock($quantite)
    {
        $this->quantiteStock += $quantite;
    }

    public function diminuerStock($quantite)
    {
        if ($quantite > $this->quantiteStock) {
            throw new Exception("Stock insuffisant");
        }

        $this->quantiteStock -= $quantite;
    }
}