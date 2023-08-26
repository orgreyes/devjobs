<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Agrega tus enlaces a hojas de estilo o CDN aquí -->
</head>
<body>
    <h2 class="text-center mb-4 text-primary">Registro de Usuario</h2>
    <div class="row justify-content-center">
        <form class="col-lg-4 border rounded p-3" action="/devjobs/registrar" method="POST">
            <div class="row mb-3">
                <div class="col">
                    <label for="usu_nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="usu_nombre" name="usu_nombre" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="usu_correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="usu_correo" name="usu_correo" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="usu_password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="usu_password" name="usu_password" required>
                </div>
            </div>
            <!-- Agrega más campos según tus requisitos (por ejemplo, confirmación de contraseña) -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>
        </form>
    </div>
    <div class="mt-3">
        <p class="mb-0 text-center">¿Ya tiene una cuenta?<a href="/devjobs/login" class="text-primary fw-bold ms-2">Iniciar Sesión</a></p>
    </div>
    <!-- Agrega tus scripts al final del cuerpo del documento -->
</body>
</html>
