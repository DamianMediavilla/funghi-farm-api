<?php

namespace Model;

class Admin extends ActiveRecord {
   
    // Base DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'user', 'password'];

    public $id;
    public $user;
    public $password;

    public function __construct($args = [])
    {
        $args=$this->sanear($args);
        $this->id = $args['id'] ?? null;
        $this->user = $args['user'] ?? '';
        $this->password = $args['password'] ?? '';
    }
    
    public function validar() {
        if(!$this->user) {
            self::$errores[] = "El Email del usuario es obligatorio";
        }
        if(!$this->password) {
            self::$errores[] = "El Password del usuario es obligatorio";
        }
        return self::$errores;
    }

    public function existeUsuario() {
        // Revisar si el usuario existe.
        $query = "SELECT * FROM " . self::$tabla . " WHERE user = '" . $this->user . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if(!$resultado->num_rows) {
            self::$errores[] = 'El Usuario No Existe';
            return;
        }

        return $resultado;
    }
    public function comprobarCredenciales(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE user = '" . $this->user . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows){
            echo'Usuario encontrado';
            $usuario = $resultado->fetch_object();
            
            if(!password_verify( $this->password, $usuario->password )) {
                echo 'El Password es Incorrecto';
                return false;
            } else{
                echo 'Credenciales correctas';
                return true;
            }
            
        }else{
            echo 'No se encuentra usuario';
        }
        return false;
    }
    public function comprobarCredencialesApi(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE user = '" . $this->user . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows){
            $usuario = $resultado->fetch_object();
            
            if(!password_verify( $this->password, $usuario->password )) {
                return false;
            } else{
                return true;
            }
            
        }else{
        }
        return false;
    }
    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();


        if(!password_verify( $this->password, $usuario->password )) {
            self::$errores[] = 'El Password es Incorrecto';
            return;
        } 
    }

    public function autenticar() {
         // El usuario esta autenticado
         session_start();

         // Llenar el arreglo de la sesión
         $_SESSION['usuario'] = $this->user;
         $_SESSION['login'] = true;

         header('Location: /admin');
    }

}
