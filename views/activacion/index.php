<h1 class="text-center">Solicitudes de Activacion de Cuenta de Usuarios</h1>
<br>
<div class="row justify-content-center">
            <form class="col-lg-8 border bg-light p-3">
            <h1 class="text-center">Asignacion de Rol al Usuario</h1><br>
            <input type="hidden" name="usu_id" id="usu_id">

            <!-- //!Nombre del Usuario -->
                <div class="row mb-3">
                    <div class="col">
                    <label for="usu_nombre">Nombre del Usuario</label>
                        <input type="text" name="usu_nombre" id="usu_nombre" class="form-control" >
                    </div>
                </div>

                <!-- //!Numero de Catálogo -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="usu_catalogo">Numero de Catálogo</label>
                        <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control">
                    </div>
                </div>

                <!-- //!Rol -->
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <label for="usu_rol">Asignar Rol a Usuario</label>
                        <select class="form-control" name="usu_rol" id="usu_rol">
                            <option value="">Seleccione un Rol...</option>
                                <?php foreach ($roles as $key => $rol) : ?>
                                        <option value="<?= $rol['rol_id'] ?>"> <?= $rol['rol_nombre'] ?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                </div>

                

                <div class="row mb-3">
                    <div class="col-lg-2">
                        <button type="button" id="btnActivar" class="btn btn-info w-100">Activar</button>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                    </div>

                </div>
            </form>
        </div>

        <br><center>
            <a href="/devjobs/menu" class="btn btn-warning">Menu</a>
        </center>
       
        <div id="tablaUsuariosContainer" class="container mt-5">
            <div class="row justify-content-center mt-4">
                <div class="col-12 p-4 shadow"> 
                    <div class="text-center">
                        <h1>Solicitudes Pendientes</h1>
                    </div>
            <table id="tablaUsuarios" class="table table-bordered table-hover">
                <!-- Contenido de la tabla -->
            </table>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/activacion/index.js') ?>"></script>