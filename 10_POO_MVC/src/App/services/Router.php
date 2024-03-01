<?php
namespace APP\services;

/**
 * very simple class Router
 * based on $_GET['page']
 */
class Router
{
    private $pages;

    public function __construct(){
        $this->setPage();
    }

    public function setPage(){
        $this->page = isset($_GET['page']) ? strtolower($_GET['page']) : 'home';
    }

    public function getPage(){
        return $this->page;
    }

}