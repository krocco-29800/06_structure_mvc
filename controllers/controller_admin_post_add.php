<?php
// on vérifie le rôle 
if(!Utils::isRole("ROLE_ADMIN"))
{
    header("Location: ?page=home");
    exit;
}
// on appelle la bdd
require_once('./models/Post.php');
// on instancie la classe $postObj
$postObj = new Post();

// création des conditions pour ajouter une card
if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['image']) ){
    // ceci va nettoyer le code de tout les symboles pour garder que les alphanumériques
    $title = htmlentities(strip_tags($_POST['title']));   
    $description = htmlentities(strip_tags($_POST['description']));
    $image = htmlentities(strip_tags($_POST['image']));
    // on ajoute la card à la bdd
    // on appelle la fonction insertPost de la classe Post 
    $post = $postObj->insertPost($title,$description,$image,$_SESSION['user']['id']);
    // redirection après ajout de la card
    header("Location: ?page=admin_post_add");
    exit;
}

// on charge la vue
include "./views/base.phtml";
?>