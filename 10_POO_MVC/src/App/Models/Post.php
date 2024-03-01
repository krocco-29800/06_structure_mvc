<?php

namespace App\Models;

use App\services\Database;

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
    
    // Fonction qui permet de modifier un post
    public function updatePost($title, $description, $image, $id_to_update){

        $query = "UPDATE post SET title = :title, description = :description, image = :image WHERE id = $id_to_update";
        $params =[
            'title' => $title,
            'description' => $description,
            'image' => $image,
                //'user_id' => $user_id, je ne pense que nous n'avons pas  ceci 
        ];
        $update = $this->db->query($query,$params);
        return $update;
    }

// Fonction qui récupère le post par son id
    public function getPostById($post_id){
        $query = "SELECT * FROM post WHERE id = $post_id";
        $post = $this->db->select($query);
        return $post;
    }
}