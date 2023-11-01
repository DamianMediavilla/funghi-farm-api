<?php
namespace Model;

class Report extends ActiveRecord{
    protected static $tabla = 'reports';
    protected static $columnasDB = ['id', 'device', 'temperature', 'humidity', 'msg', 'time_signal'];

    public $id;
    public $device;
    public $temperature;
    public $humidity;
    public $msg;
    public $time_signal;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->device = $args['device'] ?? '';
        $this->temperature = $args['temperature'] ?? '';
        $this->humidity = $args['humidity'] ?? '';
        $this->msg = $args['msg'] ?? '';
        $this->time_signal = $args['time_signal'] ?? '';
    }
}