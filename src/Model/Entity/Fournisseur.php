<?php

class Fournisseur
{
    private $id;
    private $nom;
    private $telephone;
    private $adresse;

    public function __construct($nom, $telephone, $adresse)
    {
        $this->nom = $nom;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }
}