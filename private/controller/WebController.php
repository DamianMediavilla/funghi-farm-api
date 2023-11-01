<?php
namespace Controller;

use Model\Admin;
use Router\Router;

class WebController{
    public static function index( Router $router){
        echo "desde webcontoller";
        $router->render('index',[]);
    }
}