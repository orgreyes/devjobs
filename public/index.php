<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\LoginController;
use Controllers\ActivacionController;
use Controllers\ListaController;
use Controllers\DesactivoController;
use Controllers\DetalleController;
use Controllers\ReporteController;


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
$router->post('/API/activacion/eliminar', [ActivacionController::class,'eliminarAPI']);
$router->post('/API/activacion/activar', [ActivacionController::class,'activarAPI']);
$router->post('/API/activacion/asignarol', [ActivacionController::class,'asignarolAPI']);

//!Rutas para Lista de usuarios
$router->get('/lista', [ListaController::class,'index']);
$router->get('/API/lista/buscar', [ListaController::class,'buscarAPI']);
$router->post('/API/lista/eliminar', [ListaController::class,'eliminarAPI']);
$router->post('/API/lista/modificar', [ListaController::class,'modificarAPI']);
$router->post('/API/lista/desactivar', [ListaController::class,'desactivarAPI']);

//!Rutas para Lista de usuarios desactivados
$router->get('/desactivo', [DesactivoController::class,'index']);
$router->get('/API/desactivo/buscar', [DesactivoController::class,'buscarAPI']);
$router->post('/API/desactivo/eliminar', [DesactivoController::class,'eliminarAPI']);
$router->post('/API/desactivo/activar', [DesactivoController::class,'activarAPI']);

//!Rutas de Reporte de Cantidad de usuarios activos e inactivos
$router->get('/lista/estadistica', [DetalleController::class,'index']);
$router->get('/API/lista/estadistica', [DetalleController::class,'detalleEstadosAPI']);

//!Rutas de Reporte de Cantidad de usuarios activos e inactivos
$router->get('/reporte/estadistica', [ReporteController::class,'index']);
$router->get('/API/reporte/estadistica', [ReporteController::class,'detalleEstadosAPI']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
