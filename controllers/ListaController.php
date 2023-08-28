<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use MVC\Router;

class ListaController {
    public static function index(Router $router){

        $roles = static::buscarRoles();

        $usuarios = Usuario::all();

        $router->render('lista/index', [
            'lista' => $lista,
            'roles' => $roles,
        ]);
    }

        //!--------------------------
public static function buscarRoles(){
    $sql = "SELECT * FROM rol where rol_situacion = 1";

    try {
        $roles = Usuario::fetchArray($sql);

        if($roles){
            return $roles;
        }else{
            return 0;
        }
    } catch (Exception $e) {
        
    }
}

    //!Funcion Buscar
    public static function buscarAPI()
    {

        $sql = "SELECT u.usu_id, u.usu_nombre, u.usu_catalogo, u.usu_password, r.rol_nombre
        FROM usuario u
        LEFT JOIN rol r ON u.usu_rol = r.rol_id
        WHERE u.usu_situacion = 1;";

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
    
            // Validar campos vacíos
            foreach ($usuarioData as $campo => $valor) {
                if (empty($valor)) {
                    echo json_encode([
                        'mensaje' => 'Llene Todos Los Campos',
                        'codigo' => 0
                    ]);
                    return;
                }
            }
    
            if (isset($usuarioData['usu_password'])) {
                $hashedPassword = password_hash($usuarioData['usu_password'], PASSWORD_DEFAULT);
                $usuarioData['usu_password'] = $hashedPassword;
            }
            $usuarioData['usu_situacion'] = 1;
    
            $usuario = new Usuario($usuarioData);
            $resultado = $usuario->actualizar();
    
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Actualización de Datos Correcta',
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