<?php
require_once('./models/Post.php');

$post = new Post();
$posts = $post->getAll(3);

include "./views/base.phtml";
