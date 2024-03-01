<?php
require_once('./models/Post.php');

$post = new Post();
$posts = $post->getAll(null,"SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id ASC");

include "./views/base.phtml";

