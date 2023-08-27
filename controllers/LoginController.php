<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function index(Router $router){
        if(!isset($_SESSION['auth_user'])){
            $router->render('login/index', []);
        }else{
            header('Location: /devjobs/menu');
        }
    }

    public static function menu(Router $router){
        if(isset($_SESSION['auth_user'])){
            $router->render('menu/index', []);
        }else{
            header('Location: /devjobs/');
        }
    }

    public static function indexx(Router $router){

        $router->render('registro/index', [
            'registro' => $registro,
        ]);
    }

    public static function loginAPI(){
        $catalogo = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($_POST['usu_password'], FILTER_DEFAULT);
        $usuarioRegistrado = Usuario::fetchFirst("SELECT * FROM usuario WHERE usu_catalogo = $catalogo");
    
        try {
            if (is_array($usuarioRegistrado)) {
                $verificacion = password_verify($password, $usuarioRegistrado['usu_password']);
                $nombre = $usuarioRegistrado['usu_nombre'];
                $situacion = $usuarioRegistrado['usu_situacion'];
    
                if (!$verificacion) {
                    echo json_encode([
                        'codigo' => 2,
                        'mensaje' => 'Contraseña incorrecta'
                    ]);
                } elseif ($situacion == 2) {
                    echo json_encode([
                        'codigo' => 3,
                        'mensaje' => 'Usuario pendiente de activación'
                    ]);
                } elseif ($situacion == 3) {
                    echo json_encode([
                        'codigo' => 4,
                        'mensaje' => 'Usuario desactivado'
                    ]);
                } elseif ($situacion == 1) {
                    session_start();
                    $_SESSION['auth_user'] = $catalogo;
    
                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => "Sesión iniciada correctamente. Bienvenido $nombre"
                    ]);
                }
            } else {
                echo json_encode([
                    'codigo' => 2,
                    'mensaje' => 'Usuario no encontrado'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'codigo' => 0,
                'mensaje' => 'Usuario no encontrado'
            ]);
        }
    }
    
    

    public static function logout(){
        $_SESSION = [];
        session_unset();
        session_destroy();
        header('Location: /devjobs/');
    }



    //!Funcion guardar
    public static function guardarAPI(){
        try {
            $usuarioData = $_POST; 
            
            $nombreUsuario = $usuarioData['usu_nombre'];
            $catalogoUsuario = $usuarioData['usu_catalogo'];
            
            // Verificar si ya existe un usuario con el mismo nombre o catálogo
            $usuarioExistente = Usuario::fetchFirst("SELECT * FROM usuario WHERE usu_nombre = '$nombreUsuario' OR usu_catalogo = $catalogoUsuario");
    
            if ($usuarioExistente) {
                if ($usuarioExistente['usu_nombre'] === $nombreUsuario) {
                    echo json_encode([
                        'mensaje' => 'El nombre de usuario ya existe',
                        'codigo' => 2
                    ]);
                    return;
                } elseif ($usuarioExistente['usu_catalogo'] == $catalogoUsuario) {
                    echo json_encode([
                        'mensaje' => 'El número de catálogo ya existe',
                        'codigo' => 3
                    ]);
                    return;
                }
            }
            
            $password = filter_var($usuarioData['usu_password'], FILTER_DEFAULT);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $usuarioData['usu_password'] = $hashedPassword;
    
            $usuario = new Usuario($usuarioData);
            
            $resultado = $usuario->crear();
            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro Enviado, Pendiente a ser Aprobado',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrio un error',
                    'codigo' => 0
                ]);
            }
                
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje'=> 'Ocurrio un Error',
                'codigo' => 0
            ]);
        }
    }
    
    
}