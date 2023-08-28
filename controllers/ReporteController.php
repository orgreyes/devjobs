<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use MVC\Router;

class ReporteController {
    public static function index(Router $router) {
        $detalles = Usuario::all();
    
        $router->render('reporte/estadistica', [
            'detalles' => $detalles,
        ]);
    }
    

        //!Funcion Detalle
        public static function detalleEstadosAPI()
        {
    
            $sql = " SELECT r.rol_nombre,
            (SELECT COUNT(*) 
             FROM usuario u 
             WHERE u.usu_rol = r.rol_id AND u.usu_situacion = 1) AS cantidad_usuarios
     FROM rol r
     WHERE r.rol_situacion = 1
     ORDER BY cantidad_usuarios DESC;
        
             ";
            

            try {
    
                $estados = Usuario::fetchArray($sql);
    
                echo json_encode($estados);
            } catch (Exception $e) {
                echo json_encode([
                    'detalle' => $e->getMessage(),
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        }

}


