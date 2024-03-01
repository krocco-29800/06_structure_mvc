<?php

namespace App\controllers;



use App\Models\Post;
use App\Models\User;
class HomeController
{
    public function index(){
        $title = "Hello this is the Home Controller";
        $post = new Post();
        $posts = $post->getAll(3);
        $template = './views/template_home.phtml';
        $this->render($template ,[$title] ,$posts);
    }

    public function render($templatePath, $data, $posts){
        //Ouvrir mémoire tempon du serveur
        ob_start();
        include $templatePath;
        // On charge la mémopire dans le bon template
        $template = ob_get_clean();
        include './views/base.phtml';
    }
}