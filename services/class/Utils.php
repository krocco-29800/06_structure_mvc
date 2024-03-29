<?php
class Utils{

    const DB_HOST = "localhost";
    const DB_NAME = "mvc_php";
    const DB_USER = "root";
    const DB_PASS = "";
    // Fonction de connexion à la base de données
    static function connectDB(){
        $db = false;
        try {
            $db = new PDO('mysql:host='.self::DB_HOST.';port=3306;dbname='.self::DB_NAME,self::DB_USER,self::DB_PASS);
        } catch (PDOException $e) {
            $error = $e;
            // tenter de réessayer la connexion après un certain délai, par exemple
            echo "Hum problème de connexion au serveur de base de données: ".$e;
        }
        return $db;
    }
    // Fonction de recherche de role
    static function isRole($role){ // retourne true ou false
        // Si $_SESSION['user'] est défini
        // ET $_SESSION['user']['roles'] contient le rôle indiqué
        // $is_role retourne un booleen true/false
        $is_role = isset($_SESSION['user']) && in_array($role,json_decode($_SESSION['user']['roles']));
        return $is_role;
    }
    // Fonctions de debug simple
    static function dump($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
    // Fonctions de debug avec un die
    static function dump_die($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die();
    }
    // Fonction de nettoyage des chaines provenant des formulaire
    static function inputCleaner($input){
        $string = htmlentities(strip_tags($input));
        return $string;
    }
}