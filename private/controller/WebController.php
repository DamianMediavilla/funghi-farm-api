<?php
namespace Controller;

use Model\Admin;
use Model\Report;
use Router\Router;

use function React\Promise\all;

class WebController{
    public static function index( Router $router){
        $router->render('index',[]);
    }
    public static function reporte( Router $router){
        $registros = Report::All();
        $router->render('reporte',[
            'registros'=>$registros
        ]);
    }

}