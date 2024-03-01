<?php

namespace App\controllers;



use App\Models\Post;
class SearchController
{
    public function index(){
        $title = "Hello this is the Search Controller";
        $post = new Post();
        $keywords = strip_tags(urldecode(trim($_GET['keywords'])));
        $posts = $post->getAll(null,"SELECT * FROM post WHERE title LIKE '%".$keywords."%' OR description LIKE '%".$keywords."%' OR image LIKE '%".$keywords."%' ORDER BY id");
        $template = './views/template_search.phtml';
        $this->render($template ,[$title] ,$posts, $keywords);
    }

    public function render($templatePath, $data, $posts,$keywords){
        //Ouvrir mémoire tempon du serveur
        ob_start();
        include $templatePath;
        // On charge la mémopire dans le bon template
        $template = ob_get_clean();
        include './views/base.phtml';
    }
}