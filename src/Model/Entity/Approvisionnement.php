<?php

class Approvisionnement
{
    private $id;
    private $dateReception;
    private $numeroBL;

    public function __construct($dateReception, $numeroBL)
    {
        $this->dateReception = $dateReception;
        $this->numeroBL = $numeroBL;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateReception()
    {
        return $this->dateReception;
    }

    public function getNumeroBL()
    {
        return $this->numeroBL;
    }
}

