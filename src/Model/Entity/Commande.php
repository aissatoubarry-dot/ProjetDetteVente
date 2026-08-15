<?php

class Commande
{
    private $id;
    private $dateCommande;
    private $montantTotal;
    private $modeReglement;

    public function __construct($dateCommande, $modeReglement)
    {
        $this->dateCommande = $dateCommande;
        $this->modeReglement = $modeReglement;
        $this->montantTotal = 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    public function getMontantTotal()
    {
        return $this->montantTotal;
    }

    public function getModeReglement()
    {
        return $this->modeReglement;
    }

    public function ajouterMontant($montant)
    {
        $this->montantTotal += $montant;
    }
}