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
        $usuarioRegistrado = Usuario::fetchFirst("SELECT * FROM usuario where usu_catalogo = $catalogo");

        try {
            if(is_array($usuarioRegistrado)){
                $verificacion = password_verify($password, $usuarioRegistrado['usu_password']);
                $nombre = $usuarioRegistrado['usu_nombre'];
                if($verificacion){
                    session_start();
                    $_SESSION['auth_user'] = $catalogo;

                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => "Sesion iniciada correctamente. Bienvenido $nombre"
                    ]);
                }else{
                    echo json_encode([
                        'codigo' => 2,
                        'mensaje' => 'Contraseña incorrecta'
                    ]);
                }
            }else{
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




    public static function registroAPI(Router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['usu_nombre'];
            $catalogo = $_POST['usu_catalogo'];
            $password = $_POST['usu_password'];

            // Hash de la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Aquí deberías realizar la validación y la inserción en la base de datos
            // Por ejemplo, usar consultas preparadas para evitar inyecciones SQL

            // Luego de guardar el usuario, redirige a la página de inicio de sesión
            header('Location: /devjobs/login');
            exit();
        }

        // Si no es una solicitud POST, renderiza la vista de registro
        $router->render('registro/index', []);
    }

    // Resto de tus métodos...
}