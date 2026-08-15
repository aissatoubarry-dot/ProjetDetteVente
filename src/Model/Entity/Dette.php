<?php

class Dette
{
    private $id;
    private $montantInitial;
    private $montantRestant;
    private $statut;

    public function __construct($montantInitial)
    {
        $this->montantInitial = $montantInitial;
        $this->montantRestant = $montantInitial;
        $this->statut = "EN_COURS";
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMontantInitial()
    {
        return $this->montantInitial;
    }

    public function getMontantRestant()
    {
        return $this->montantRestant;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function enregistrerPaiement($montant)
    {
        if ($montant > $this->montantRestant) {
            throw new Exception("Le paiement dépasse le montant restant");
        }

        $this->montantRestant -= $montant;

        if ($this->montantRestant == 0) {
            $this->statut = "SOLDEE";
        }
    }
}