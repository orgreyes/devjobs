<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use MVC\Router;

class ListaController {
    public static function index(Router $router){

        $router->render('lista/index', [
            'lista' => $lista,
        ]);
    }


    //!Funcion Buscar
    public static function buscarAPI()
    {

        $sql = "SELECT * FROM usuario WHERE usu_situacion = 1 ";

        try {

            $usuarios = Usuario::fetchArray($sql);

            echo json_encode($usuarios);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    //!Funcion Activar
    public static function desactivarAPI(){
        try{
            $usu_id = $_POST['usu_id'];
            $usuario = Usuario::find($usu_id);
            $usuario->usu_situacion = 3;
            $resultado = $usuario->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Usuario Desactivado Exitosamente',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrio un error',
                    'codigo' => 0
                ]);
            }
        }catch(Exception $e){
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje'=> 'Ocurrio un Error',
                'codigo' => 0
        ]);
        }
    }
    

    //!Funcion Eliminar
    public static function eliminarAPI(){
        try{
            $usu_id = $_POST['usu_id'];
            $usuario = Usuario::find($usu_id);
            $usuario->usu_situacion = 0;
            $resultado = $usuario->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Usuario Eliminado correctamente',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrio un error',
                    'codigo' => 0
                ]);
            }
        }catch(Exception $e){
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje'=> 'Ocurrio un Error',
                'codigo' => 0
        ]);
        }
    }

    public static function modificarAPI() {
        try {
            $usuarioData = $_POST;
            
            // Hashing de la contraseña
            if (isset($usuarioData['usu_password'])) {
                $hashedPassword = password_hash($usuarioData['usu_password'], PASSWORD_DEFAULT);
                $usuarioData['usu_password'] = $hashedPassword;
            }
    
            // Establecer usu_situacion en código 1
            $usuarioData['usu_situacion'] = 1;
    
            $usuario = new Usuario($usuarioData);
            $resultado = $usuario->actualizar();
    
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Actualizacion de Datos Correcta',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un Error',
                'codigo' => 0
            ]);
        }
    }
}    