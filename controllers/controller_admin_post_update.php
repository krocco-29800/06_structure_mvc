<?php
// on vérifie le rôle n'existe pas  ou si l'utilisateur n'a pas le droit d'admin
if(!Utils::isRole("ROLE_ADMIN"))
{
    header("Location: ?page=home");
    exit;
}
// Appelle ma class Post
require_once('./models/Post.php');

// On instancie la class $postObj
$postObj = new Post();

$post_id = (int)$_GET['id'];
$the_post = $postObj->getPostById($post_id);

if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image'])  && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['image']) ){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    var_dump($image);
    // on modifie le post
    $post = $postObj->updatePost($title,$description,$image,$post_id);
    header("Location: ?page=admin");
    exit;
}

// on charge la vue
include "./views/base.phtml";
?> 