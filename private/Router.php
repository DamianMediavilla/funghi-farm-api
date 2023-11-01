<?php

namespace Router;

class Router{
    
    public $rutasGET = [];
    public $rutasPOST = [];
    
    public function get($url, $function){
        $this->rutasGET[$url]=$function;
    }
    public function post($url, $function){
        $this->rutasPOST[$url]=$function;
    }

    public function comprobarRutas()
    {//URLACTUAL DEPENDE DEL LOCAL O REMOTO
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        //$rutasprotegidas=['/admin', '/admin/propiedades/crear', '/admin/propiedades/actualizar','/admin/vendedores/admin','/admin/vendedores/crear' ,'/admin/vendedores/actualizar'];
        //$urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' :  $_SERVER['REQUEST_URI'];
        $metodo = $_SERVER['REQUEST_METHOD'];
        if ($metodo === 'GET'){
            $function = $this->rutasGET[$urlActual] ?? null ;
        } else if ($metodo === 'POST'){
            $function = $this->rutasPOST[$urlActual] ?? null ;

        }
        if ($function){
           //debuguear($function);
            //se comprobó la ruta y se conoce la funcion
            call_user_func($function, $this);
        } else{
            echo "pagina no encontrada";
        }

    }
    public function render($view, $datos=[]){
        foreach($datos as $key => $value){
            $$key = $value;
        }
        
        ob_start();
        
        include __DIR__ . "/view/$view.php";

        $contenido= ob_get_clean();

        include __DIR__ . "/view/layout.php";
        
    }
}
