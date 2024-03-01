<?php

namespace App\controllers;



use App\Models\Post;
class GalleryController
{
    public function index(){
        $title = "Hello this is the Gallery Controller";
        $post = new Post();
        $posts = $post->getAll(null,"SELECT post.*,contact.firstname,contact.lastname FROM post,contact WHERE post.user_id=contact.user_id ORDER BY id ASC");
        $template = './views/template_gallery.phtml';
        $this->render($template,[$title],$posts);
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
