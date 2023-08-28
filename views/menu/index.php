<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <title>Navbar con Bootstrap</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <a class="navbar-brand" href="#">
  <img src="<?= asset('images/cit.png') ?>" alt="Logotipo" style="max-width: 40px; height: auto;">
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

      <a class="navbar-brand" href="#">Parcial Reyes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="usuariosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Lista de Usuarios
            </a>
            <ul class="dropdown-menu" aria-labelledby="usuariosDropdown">
              <li><a class="dropdown-item" href="/devjobs/activacion">Solicitud de Usuarios Pendientes</a></li>
              <li><a class="dropdown-item" href="/devjobs/lista">Lista de Usuarios Activos</a></li>
              <li><a class="dropdown-item" href="/devjobs/desactivo">Lista de Usuarios Desactivados</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reporte de Gráficas
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/devjobs/lista/estadistica">Reporte de cantidad de Usuarios Activos e Inactivos</a></li>
              <li><a class="dropdown-item" href="/devjobs/reporte/estadistica">Reporte de cantidad de Usuarios por Rol</a></li>
            </ul>
          </li>
        </ul>
        </div>
    <div class="d-flex">
      <a href="/devjobs/" class="btn btn-info me-2">Menu Principal</a>
      <a href="/devjobs/logout" class="btn btn-danger">Cerrar Sesión</a>
    </div>
  </div>
</nav>
         
<div class="container text-center">
  <h1>Bienvenido</h1>
  <img src="<?= asset('images/cit.png') ?>" alt="Logotipo" style="max-width: 800px;">
  <!-- Contenido de tu página MVC aquí -->
</div>

<div class="container-fluid footer">
  <p style="font-size: xx-small; font-weight: bold;">
    Comando de Informática y Tecnología, <?= date('Y') ?> &copy;
  </p>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
