<?php

namespace Model;

class Encuesta extends ActiveRecord {
    protected static $tabla = 'encuestas';
    protected static $columnasDB = ['id', 'numero', 'edad', 'region_origen', 'region_actual', 'sexo', 'instrumento', 'estudios', 's_fisica', 's_emocional', 's_mental', 'lesion', 'medicacion', 'comentarios', 'sintomatologia'];

    
    public $id;
    public $numero;
    public $edad;
    public $region_origen;
    public $region_actual;
    public $estudios;
    public $sexo;
    public $instrumento;
    public $s_fisica;
    public $s_emocional;
    public $s_mental;
    public $sintomatologia;
    public $lesion;
    public $medicacion;
    public $comentarios;
    

    public function __construct($args = [])
    {
        //$args=$this->sanear($args);
        if (isset($args['s_fisica'])){
            $s_fisica=implode("-",array_keys($args['s_fisica']));
        }
        if (isset($args['s_mental'])){
            $s_mental=implode("-",array_keys($args['s_mental']));
        }
        if (isset($args['s_emocional'])){
            $s_emocional=implode("-",array_keys($args['s_emocional']));
        }
        if (isset($args['s_emocional'])){
            $s_emocional=implode("-",array_keys($args['s_emocional']));
        }

        if (isset($args['sintomatologia'])){
            $this->sintomatologia= json_encode($args['sintomatologia']);
        }
        else{
            $this->sintomatologia= "";

        }
        $this->id = $args['id'] ?? null;
        $this->numero = $args['numero'] ?? '';
        $this->edad = $args['edad'] ?? '';
        $this->region_origen = $args['region_origen'] ?? '';
        $this->region_actual = $args['region_actual'] ?? '';
        $this->estudios= $args['estudios'] ?? '';
        $this->sexo= $args['sexo'] ?? '';
        $this->instrumento= $args['instrumento'] ?? '';
        $this->s_fisica= $s_fisica ?? '';
        $this->s_emocional= $s_emocional ?? '';
        $this->s_mental= $s_mental ?? '';
        $this->lesion= $args['lesion'] ?? '';
        $this->medicacion= $args['medicacion'] ?? '';
        $this->comentarios = $args['comentarios'] ?? '';
    }
    public function arrayToStringCSV($arr=[]){  
        //foreach ()

    }
    public function refresh($args=[]){
        if (isset($args['s_fisica'])){
            $args['s_fisica']=implode("-",array_keys($args['s_fisica']));
        }
        if (isset($args['s_mental'])){
            $args['s_mental']=implode("-",array_keys($args['s_mental']));
        }
        if (isset($args['s_emocional'])){
            $args['s_emocional']=implode("-",array_keys($args['s_emocional']));
        }
        if (isset($args['sintomatologia'])){
            $this->sintomatologia= json_encode($args['sintomatologia']);
           
            
        }
        else{
            $this->sintomatologia= "";
            
        }
        foreach($args as $key=>$value){
            $this->$key=$value;
        }
        
    }
    public function explotar_string($string){
        return explode("-",$string);
    }
    public function desglose($json){
        $obj='';
        return $obj;
    }
    public function englose(){
        $sintomatologia=['s_fisica'=>['antes'=>'implotado1','durante'=>'implotado1','posterior'=>'implotado1']];
        $json=json_encode($sintomatologia);
        return $json;
    }
    public function tiene_sintoma(string $tipo, string $tiempo, string $sintoma):string {
        /**
         * Evalua si en la instancia de Encuesta, esta definido el tipo de sintoma. 
         * @access public
         * @param string $tipo Tipo de sintoma (fisico, mental, emocional)
         * @param string $tiempo Tiempo del sintoma (anterior, druante, posterior)
         * @param string $sintoma Sintoma (sudoracion, temblores, mareo...)
         * @return string 'checked' or ''
         * 
         */
        $sintomas_desglose = json_decode($this->sintomatologia,true);
        // var_dump($this->sintomatologia);
        // var_dump($sintomas_desglose);
        // exit;
        if(!is_array($sintomas_desglose)){
            return '';
        }
        if (array_key_exists($tipo,$sintomas_desglose)){
            if (array_key_exists($tiempo,$sintomas_desglose[$tipo])){
                if (array_key_exists($sintoma,$sintomas_desglose[$tipo][$tiempo])){
                    return 'checked';
                }
            }
        }
        return '';
    }
}
