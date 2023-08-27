<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\LoginController;
use Controllers\ActivacionController;


$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

//!Rutas para El Login
$router->get('/', [LoginController::class,'index']);
$router->get('/menu', [LoginController::class,'menu']);
$router->get('/logout', [LoginController::class,'logout']);
$router->post('/API/login', [LoginController::class,'loginAPI']);

//!Rutas para El Registro de Uusarios
$router->get('/registro', [LoginController::class,'indexx']);
$router->post('/API/registro/guardar', [LoginController::class,'guardarAPI']);

//!Rutas para Activar a los usuarios
$router->get('/activacion', [ActivacionController::class,'index']);
$router->get('/API/activacion/buscar', [ActivacionController::class,'buscarAPI']);
$router->post('/API/activacion/guardar', [ActivacionController::class,'guardarAPI']);
$router->post('/API/activacion/eliminar', [ActivacionController::class,'eliminarAPI']);
$router->post('/API/activacion/activar', [ActivacionController::class,'activarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
