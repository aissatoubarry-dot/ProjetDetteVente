<?php

class Database
{
    private static $instance = null;
    private $connexion;

    private function __construct()
    {
        try {
            $this->connexion = new PDO(
                "pgsql:host=localhost;port=5432;dbname=projetdettevente",
                "postgres",
                "barry@123"
            );

            $this->connexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (PDOException $erreur) {

            $this->connexion = new PDO("sqlite:erp.db");

            $this->connexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnexion()
    {
        return $this->connexion;
    }
}