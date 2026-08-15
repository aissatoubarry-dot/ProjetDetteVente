<?php

class LigneApprovisionnement
{
    private $id;
    private $quantiteRecue;
    private $prixAchatUnitaire;

    public function __construct($quantiteRecue, $prixAchatUnitaire)
    {
        $this->quantiteRecue = $quantiteRecue;
        $this->prixAchatUnitaire = $prixAchatUnitaire;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getQuantiteRecue()
    {
        return $this->quantiteRecue;
    }

    public function getPrixAchatUnitaire()
    {
        return $this->prixAchatUnitaire;
    }

    public function calculerMontant()
    {
        return $this->quantiteRecue * $this->prixAchatUnitaire;
    }
}

