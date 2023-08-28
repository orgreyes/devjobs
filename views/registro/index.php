<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
<style>
    body {
      padding-top: 56px;
      position: relative;
      min-height: 100vh;
    }
    .footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      text-align: center;
      padding: 10px 0;
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>
    <h2 class="text-center mb-4 text-primary">Registro de Usuario</h2>
    <div class="row justify-content-center">
        <form id="formRegistro" class="col-lg-4 border rounded p-3" action="/devjobs/registrar" method="POST">
            <div class="row mb-3">
                <div class="col">
                    <label for="usu_nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="usu_nombre" name="usu_nombre" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="usu_catalogo" class="form-label">Catálogo</label>
                    <input type="number" class="form-control" id="usu_catalogo" name="usu_catalogo" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="usu_password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="usu_password" name="usu_password" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-check-label" for="show_password">
                        <input type="checkbox" id="show_password">
                        Mostrar Contraseña
                    </label>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>
        </form>
    </div>
    <div class="mt-3">
        <p class="mb-0 text-center">¿Ya tiene una cuenta?<a href="/devjobs/" class="text-primary fw-bold ms-2">Iniciar Sesión</a></p>
    </div>
    <div class="container-fluid footer">
  <p style="font-size: xx-small; font-weight: bold;">
    Comando de Informática y Tecnología, <?= date('Y') ?> &copy;
  </p>
</div>
    <script src="<?= asset('./build/js/registro/index.js') ?>"></script>
</body>
</html>
