<?php
namespace APP;
session_start();
//On charge l'autoload
use APP\services\Router;
require_once("config.php");
require_once("autoload.php");


// On détermine quelle page doit être affichée
//?page=
$router = new Router();
$page = $router->getPage();
$controllerName = "App\\controllers\\".ucfirst($page)."controller"; //Exemple : App\controllers\HomeController
$controller = new $controllerName(); //$controllers = new HomeController
$controller->index();