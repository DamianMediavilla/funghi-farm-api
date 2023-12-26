<?php
namespace Controller;

use Model\Device;
use Model\Report;
use Router\Router;

class ApiController{
    
    /* VALIDACIONES
    public static function validarSesion(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['validar'])){
            echo "denied";
            exit;
        }
    }
    
    /// Endpoints
    public static function login(Router $router){
        //buscar en base de datos si coincide
        $credenciales=$_POST;
        $usuario_evaluado= new Admin($credenciales);
        if ( $usuario_evaluado->comprobarCredencialesApi()){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
                $_SESSION['validar']=true;
            }
            echo "true";

        }else{
            echo "false";
        }
        
    }
    public static function logout(Router $router){
        session_start();
        $_SESSION=[];
        echo "true";

    }
    */
    public static function create(Router $router){
        //self::validarSesion();

        $datos = file_get_contents('php://input');
        $datos = json_decode($datos, true);
        $report = new Report($datos);
        
        if($report->guardar()){
            echo "true";
            echo time();
        }else{
            echo "false";
        }
        
    }
    // public static function actualizar(Router $router){
    //     self::validarSesion();
    //     $datos = file_get_contents('php://input');
    //     $datos = json_decode($datos, true);
    //     $encuesta = Encuesta::buscaId($datos['id']);
  
    //     $encuesta->refresh($datos);
    //     if($encuesta->actualizar()){
    //         echo true;ñ
    //     }else{
    //         echo false;
    //     }
    // }
    // public static function ver(Router $router){
    //     self::validarSesion();
    //     if($encuesta = Encuesta::buscaId($_POST['id'])){
    //         $encuesta->sintomatologia= json_decode($encuesta->sintomatologia);
    //         echo json_encode($encuesta);
    //     }else{
            
    //         echo json_encode("");
    //     };
    // }
    // public static function eliminar(Router $router){
    //     self::validarSesion();
    //     $encuesta = Encuesta::buscaId($_GET['id']);
    //     if($encuesta->eliminar()){
    //         echo "eliminado";
    //     }else{
    //         echo "error";
    //     }
        
    // }
    
    // public static function all(Router $router){
    //     self::validarSesion();
    //     $encuestas= Encuesta::All();
    //     foreach ($encuestas as $encuesta){
    //         $encuesta->sintomatologia= json_decode($encuesta->sintomatologia);
    //     };
    //     echo  json_encode($encuestas);
    // }
    // public static function getcsv(Router $router){
    //     self::validarSesion();
    //     $encuestas=Encuesta::All();
    //     $file = fopen('datosdescargables.csv', 'w');
    //     //$table_head=['id', 'numero', 'edad', 'region', 'estudios', 'sexo', 'instrumento', 's_fisica', 's_emocional', 's_mental', 'lesion', 'medicacion', 'comentarios'];
    //     //fputcsv($file, $table_head, ';');    
    //     fputcsv($file, array_keys((array)$encuestas[0]), ';');
    //     foreach ($encuestas as $encuesta):
    //         fputcsv($file, array_values((array)$encuesta), ';');
    //     endforeach;
    //     fclose($file);
    //     $file = "datosdescargables.csv";
    //     header('Content-Description: File Transfer');
    //     header('Content-Disposition: attachment; filename=datos.csv');
    //     header('Expires: 0');
    //     header('Cache-Control: must-revalidate');
    //     header('Pragma: public');
    //     header('Content-Length: ' . filesize($file));
    //     header("Content-Type: text/csv");
    //     readfile($file);
    // }
}
