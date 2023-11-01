<?php
namespace Controller;

use Model\Encuesta;
use Route\Router;

class ControllerPagProt{

    public static function validarSesion(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['validar'])){
            header('Location: /login');
        }
    }
    public static function admin( Router $router){
        self::validarSesion();
        $encuestas= Encuesta::All();
        $msj= in_array('msj',$_GET)?$_GET['msj']:'';
        switch($msj){
            case 1:
                $mensaje= 'Regisro Creado correctamente';
                break;
            case 2:
                $mensaje= 'Regisro Actualizado correctamente';
                break;
            case 3:
                $mensaje= 'Regisro Eliminado correctamente';
                break;
            default:
                $mensaje= '';

        }
        $router->render('admin',[
            'encuestas'=> $encuestas,
            'mensaje'=>$mensaje
        ]);
    }
    
    public static function crear( Router $router){
        self::validarSesion();
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            //instanciar nuevo objeto con los datos
            $encuesta= new Encuesta($_POST);
            //Chequear que los datos esten correctos
            $encuesta->refresh($_POST);
            
            if($encuesta->guardar()){
                header('Location: /admin?msj=1');
            }else{
                echo "insercion a DB fallida";
            }
        };
      
       
     
        $router->render('crear',[
          
            ]);
    }
    public static function actualizar( Router $router){
        self::validarSesion();
        $encuesta = Encuesta::buscaId($_GET['id']);
        
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            //instanciar nuevo objeto con los datos
            //$encuesta= new Encuesta($_POST);
            //Chequear que los datos esten correctos
            //
            //var_dump($_POST);
            //var_dump($encuesta);
            $encuesta->refresh($_POST);
            //var_dump($encuesta);
            //exit;
            if($encuesta->actualizar()){
                
                header('Location: /admin?msj=2');
            }else{
                echo "insercion a DB fallida";
            }
        };
        $fisico = $encuesta->explotar_string($encuesta->s_fisica);
        $mental = $encuesta->explotar_string($encuesta->s_mental);
        $emocional = $encuesta->explotar_string($encuesta->s_emocional);
        $sintomatologia= json_decode($encuesta->sintomatologia, true);

        $router->render('actualizar',[
            'encuesta'=> $encuesta,
            's_fisica'=> $fisico,
            's_mental'=> $mental,
            's_emocional'=> $emocional,
            'sintomatologia' => $sintomatologia
        ]);
    }
    public static function eliminar(Router $router){
        self::validarSesion();
        $encuesta = Encuesta::buscaId($_GET['id']);
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            if($encuesta->eliminar()){
                header('Location: /admin?msj=3');

            };
            
        }
        $router->render('eliminar',[
        ]);
    }

    public static function download(Router $router){
        self::validarSesion();
        $encuestas=Encuesta::All();
        $file = fopen('datosdescargables.csv', 'w');
        //$table_head=['id', 'numero', 'edad', 'region', 'estudios', 'sexo', 'instrumento', 's_fisica', 's_emocional', 's_mental', 'lesion', 'medicacion', 'comentarios'];
        //fputcsv($file, $table_head, ';');    
        fputcsv($file, array_keys((array)$encuestas[0]), ';');
        foreach ($encuestas as $encuesta):
            fputcsv($file, array_values((array)$encuesta), ';');
        endforeach;
        fclose($file);
        $file = "datosdescargables.csv";
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=datos.csv');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/csv");
        readfile($file);
    }

}