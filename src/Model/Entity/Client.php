<?php

class Client
{
    private $id;
    private $nom;
    private $prenom;
    private $telephone;
    private $limiteCredit;

    public function __construct($nom, $prenom, $telephone, $limiteCredit = 0)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->limiteCredit = $limiteCredit;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getLimiteCredit()
    {
        return $this->limiteCredit;
    }
}