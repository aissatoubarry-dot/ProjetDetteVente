<?php

class Paiement
{
    private $id;
    private $montant;
    private $datePaiement;
    private $modePaiement;

    public function __construct($montant, $datePaiement, $modePaiement)
    {
        $this->montant = $montant;
        $this->datePaiement = $datePaiement;
        $this->modePaiement = $modePaiement;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function getDatePaiement()
    {
        return $this->datePaiement;
    }

    public function getModePaiement()
    {
        return $this->modePaiement;
    }
}