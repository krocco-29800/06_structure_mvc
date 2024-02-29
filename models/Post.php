<?php
require_once("./services/class/Database.php");
class Post
{
    // propriété $db pour stocker PDO
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAll($nb=null,$query = "SELECT * FROM post ORDER BY id ASC "){
        $limit = !is_null($nb) ? "LIMIT ".$nb : "";
        $posts = [];
        $posts = $this->db->selectAll($query.$limit);
        return $posts;
    }

    public function insertPost($title,$description,$image,$user_id){
        $user_id = $_SESSION['user']['id'];
        $query = "INSERT INTO post(title,description,image,user_id) VALUES (:title,:description,:image,:user_id)";
        $params = [
            "title" => $title,
            "description" => $description,
            "image" => $image,
            "user_id" => $user_id
        ];
        $insert = $this->db->query($query,$params);
        return $insert;
    }
    
}