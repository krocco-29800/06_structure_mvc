<?php

if ( !Utils::isRole("ROLE_ADMIN") ){
    header("Location:?page=home");
    exit();
}
require_once('./models/Post.php');
$post_id = (int)$_GET['id'];
$post = new Post();
$posts = $post->getAll(null,"DELETE FROM post WHERE id=$post_id");

header("Location:?page=admin");


include "./views/base.phtml";