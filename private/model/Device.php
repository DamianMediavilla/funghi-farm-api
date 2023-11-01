<?php
namespace Model;

class Device extends ActiveRecord{
    protected static $tabla = 'devices';
    protected static $columnasDB = ['id', 'name_model', 'location', 'info'];

    public $id;
    public $name_model;
    public $location;
    public $info;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->name_model = $args['name_model'] ?? '';
        $this->location = $args['location'] ?? '';
        $this->info = $args['info'] ?? '';
    }
}