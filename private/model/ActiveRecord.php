<?php

namespace Model;

class ActiveRecord {
    protected static $db;
    protected static $columnasDB = ['columnas'];
    protected static $tabla = '';
    protected static $errores = [];

    //definir conexion DB
    public static function setDB($database){
        self::$db = $database;
    }

    public $id;

    public function __construct($args=[]){
        $this->id =$args['id'] ?? '';
        
    }

    public function sanear($array = []){
        //recibe un array de entradas ingresadas por el usuario y devuelve escapados los caracteres especiales para prevenir SQL injecion
        foreach ($array as $key=>$value){
            $array[$key]= self::$db->escape_string($value);
        };
        return $array;
    }

    public function guardar(){
        //sanitizacion
        $atributos = $this->sanitizarAtributos();
        //insercion en DB
        // $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, toilet, garage, vendedorId, creado  ) VALUES ( '$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion',  '$this->habitaciones', '$this->toilet', '$this->garage', '$this->vendedorId', '$this->creado' )";
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        // echo $query;
        // exit;
        $resultado = self::$db->query($query);
        return $resultado;
    }
    public function actualizar(){      
        //sanitizacion
        $atributos = $this->sanitizarAtributos();
        //insercion en DB
        //$query = "UPDATE " . static::$tabla . " SET titulo = '$this->titulo', precio = '$this->precio', descripcion = '$this->descripcion', habitaciones = '$this->habitaciones', toilet = '$this->toilet', garage = '$this->garage', vendedorId = '$this->vendedorId', imagen = '$this->imagen'  WHERE idProp = '$this->idProp' ";
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
       
        $query = "UPDATE " . static::$tabla . " SET ";
        $query.= join(', ', $valores );
        $query.= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query.= " LIMIT 1";
        $resultado = self::$db->query($query);
  
        
        return $resultado;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado=[];
        foreach ($atributos as $key=>$value){
            if (is_string($value)){
                $sanitizado[$key] = self::$db->escape_string($value);
            }
        }
        return $sanitizado;
    }

    public function atributos(){
        $atributos =[];
        foreach(static::$columnasDB as $columna){
            if($columna==='id') continue;
            $atributos[$columna] = $this->$columna;
            if($columna==='') continue;
            // echo $columna . "------" . $atributos[$columna];
            // echo "</br>";
        }
        return $atributos;
    }
    public static function getErrores(){
        return self::$errores;
    }
 
    public static function get($limite) { //devuelve solo $limite resultados
        $query = "SELECT * FROM " . static::$tabla . " LIMIT = " . $limite;

        $resultado = self::consultarSQL($query);
        return $resultado;
    }
   
    public static function All(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado =self::consultarSQL($query);
        return $resultado;
    }
    
    public static function buscaId($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] . " = $id";
        $resultado =self::consultarSQL($query);
        return array_shift($resultado);

    }

    public static function consultarSQL($query){
        //consulta db
        $resultado = self::$db->query($query);
        //itera resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[]= self::crearObjeto($registro);
        }
        //libera memoria
        $resultado->free();
        //retorna resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto=new static;
        foreach($registro as $key=>$value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;

    }

    public function sincronizar($args = []){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }

    public function eliminar() {
        // Eliminar el registro
        $query = "DELETE FROM "  . static::$tabla . " WHERE ". static::$columnasDB[0] . " =  " . $this->id . "  LIMIT 1";
        $resultado = self::$db->query($query);

        return $resultado;
    }
 
}
