<?php

require_once dirname(__DIR__)."/../Core/Database.php";
require_once dirname(__DIR__)."/Entity/Client.php";

class ClientRepository{

    private $connexion;

    public function __construct(){
        $this->connexion = Database :: getInstance() -> getConnexion();
    }

    public function getAllClients(){

        $sql = "SELECT * FROM client";

        $prepare = $this->connexion -> prepare($sql);
        $prepare->execute();

        $clients = $prepare -> fetchAll(PDO::FETCH_CLASS, "Client");

        return $clients;
    }

    public function getClientById(int $id){

        $sql = "SELECT * FROM client WHERE id = :id";

        $prepare = $this->connexion -> prepare($sql);
        $prepare->execute(['id' => $id]);

        $client = $prepare -> fetch(PDO::FETCH_CLASS, "Client");

        return $client;
    }
}