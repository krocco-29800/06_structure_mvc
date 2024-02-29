<?php

// on appelle le models class Post qui est le module 
require_once('./models/Post.php');

$post = new Post();
$keywords = strip_tags(urldecode(trim($_GET['keywords']))); // "trim" sert à enlever les espaces avant après lekeywords "urlcode" sert à décoder les caractères spéciaux
// et strip_tags sert à enlever toutes balises tags <....>

$posts = $post->getAll(null,"SELECT * FROM post WHERE title LIKE '%".$keywords."%' OR description LIKE '%".$keywords."%' OR image LIKE '%".$keywords."%' ORDER BY id");

// on charge la vue
include "./views/base.phtml";

?>