<?php

if ( !Utils::isRole("ROLE_ADMIN") ){
    header("Location:?page=home");
    exit();
}

require_once('./models/Post.php');


$post = new Post();
$posts = $post->getAll(null,"SELECT * FROM post ORDER BY id ASC");
// blah blah blah
// On charge la vue
include "./views/base.phtml";





