<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../private/config/conexion.php';

use Router\Router;
use Model\ActiveRecord;
use Controller\ApiController;
//include '../private/controller/WebController.php';
use Controller\WebController;


$db = conectarDb();
ActiveRecord::setDB($db); 
$router = new Router();

//rutas publicas para frontend
$router->get('/', [WebController::class, 'index']);
// $router->post('/login', [ControllerPaginaPublica::class, 'login']);
// $router->get('/login', [ControllerPaginaPublica::class, 'login']);
// $router->get('/logout', [ControllerPaginaPublica::class, 'logout']);
// $router->get('/info', [ControllerPaginaPublica::class, 'info']);

//Rutas publicas API tokenizadas JSON
$router->post('/api/carga', [ApiController::class, 'cargar']);
$router->post('/api/create', [ApiController::class, 'create']);
$router->get('/api/instrucciones/id', [ApiController::class, 'instrucciones']);


//Rutas privadas
$router->post('/datos/all', [ApiController::class, "all"]);
$router->comprobarRutas();