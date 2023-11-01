<?php
namespace Controller;

use Model\Admin;
use Route\Router;

class ControllerPaginaPublica{
    public static function index( Router $router){
        $router->render('index',[]);
    }
    public static function login( Router $router){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            //validacion de usuarios
            $user=$_POST['login']['user'];
            $pass=$_POST['login']['password'];
            //buscar en base de datos si coincide
            $credenciales=$_POST['login'];
            $usuario_evaluado= new Admin($credenciales);
            
           
          
            if ( $usuario_evaluado->comprobarCredenciales()){
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                    $_SESSION['validar']=true;
                }

            }else{
                $mensaje = 'Usuario o Contraseña incorrectos';
            }
            if(!isset($mensaje)){
                
                
                header('Location: /admin');
            }
            
        }
        $router->render('login',[]);
    }
    public static function logout( Router $router){
        session_start();
        $_SESSION=[];
        $router->render('logout',[]);
    }
    public static function info( Router $router){
        
        $router->render('info',[]);
    }


}