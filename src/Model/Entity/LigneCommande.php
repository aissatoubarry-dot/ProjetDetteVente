<?php

class LigneCommande
{
    private $id;
    private $quantite;
    private $prixUnitaire;

    public function __construct($quantite, $prixUnitaire)
    {
        $this->quantite = $quantite;
        $this->prixUnitaire = $prixUnitaire;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    public function calculerMontant()
    {
        return $this->quantite * $this->prixUnitaire;
    }
}