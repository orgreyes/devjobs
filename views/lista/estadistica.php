<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios activos e inactivos</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Reporte de Usuarios activos e inactivos</h1>
        <div class="text-center">
            <button id="btnActualizar" class="btn btn-info">Actualizar</button>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <canvas id="chartEstados" style="width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=asset('./build/js/lista/estadistica.js')?>"></script>
</body>
</html>
