<?php

namespace APP\services;

use PDO;
use PDOException;
class Database{
    // propriétés de notre class :
    private $db_host;
    private $db_name;
    private $db_port;
    private $db_user;
    private $db_pass;
    // propriété dsn ==> Data Ressource Name
    private $db_dsn;
    //PDO qu'on connait bien
    private $pdo;
    public function __construct(
        $db_host='localhost',
        $db_name='mvc_php',
        $db_port='3306',
        $db_user='root',
        $db_pass=''
    ){
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_port = $db_port;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_dsn = 'mysql:host='.$this->db_host.';dbname='.$this->db_name.';port='.$this->db_port.'charset=utf8';
    }
    private function getPdo(){
        //si PDO n'est pas déjà connecter
        if($this->pdo === null){
            //il essaye de se connecter au serveur
            try {
                $db = new PDO($this->db_dsn,$this->db_user,$this->db_pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $error) {
                //si il a une erreur de connexion il affichera un message d'erreur
                echo "Hum problème de connexion au serveur de base de données: ".iconv('ISO-8859-1','UTF-8',$error->getMessage());
                //die() pour arreter le script
                die();
            }
            //si il a réussi à ce connecter on passe à la suite du code
            $this->pdo = $db;
        }
        // TOUT EST BON POUR AVOIR NOTRE OBJET LES ZAMIS !!
        // PDO n'est appelé qu'une seule fois
        return $this->pdo;
    }
    public function selectAll($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);// ça remplace bindParam
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function select($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);// ça remplace bindParam
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function query($statement,$params=[]){
        $sql = $this->getPDO()->prepare($statement);
        $sql->execute($params);// ça remplace bindParam
        return $this->getPDO();
    }
}