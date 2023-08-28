import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje"
import { validarFormulario, Toast } from "../funciones"
import Swal from "sweetalert2";


const formulario = document.querySelector('form');
const btnAsignarRol = document.getElementById('btnAsignarRol');
const btnCancelar = document.getElementById('btnCancelar');
const tablaUsuariosContainer = document.getElementById('tablaUsuariosContainer');
let contenedor = 1;

//!Ocultar el formulario al inicio
formulario.style.display = 'none';
tablaUsuariosContainer.style.display = 'block'; 

const datatable = new Datatable('#tablaUsuarios', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            render: () => contenedor++
        },
        {
            title: 'USUARIO',
            data: 'usu_nombre'
        },
        {
            title: 'CATALOGO',
            data: 'usu_catalogo',
        },
        {
            title: 'ROL',
            data: 'rol_nombre',
            render: (data, type, row) => {
                if (type === 'display' && (data === null || data === '')) {
                    return '<span style="color: red;">PENDIENTE A ASIGNAR</span>';
                }
                return data;
            },
        },
        {
            title: 'ASIGNAR ROL',
            data: 'usu_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-nombre='${row["usu_nombre"]}' data-catalogo='${row["usu_catalogo"]}'>Asignara Rol</button>`
        },
        {
            title: 'ACTIVAR',
            data: 'usu_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-info" data-id='${data}' data-nombre='${row["usu_nombre"]}' data-catalogo='${row["usu_catalogo"]}'>Activar Usuario</button>`
        },
        {
            title: 'ELIMINAR',
            data: 'usu_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-danger" data-id='${data}'>Eliminar Solicitud</button>`
        }
    ]
});




//!Aca esta la funcion para buscar
const buscar = async () => {
    contenedor = 1;

    const url = `/devjobs/API/activacion/buscar`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        console.log(data);
        datatable.clear().draw()
        if (data) {
            datatable.rows.add(data).draw();
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            })
        }

    } catch (error) {
        console.log(error);
    }
}


//!Aca esta la funcion de Acticar un Usuario
const activar = async e => {
    const button = e.target;
    const id = button.dataset.id;

    // Verificar si el usuario tiene un rol asignado antes de activar
    const rolNombre = button.dataset.rolNombre;
    if (rolNombre === '' || rolNombre === null) {
        Swal.fire({
            icon: 'warning',
            title: 'Rol no asignado',
            text: 'El usuario aún no tiene un rol asignado.',
            confirmButtonText: 'OK'
        });
        return; // Detener el proceso
    }

    const result = await Swal.fire({
        icon: 'question',
        title: 'Activar Usuario',
        text: '¿Desea Activar a este Usuario?',
        showCancelButton: true,
        confirmButtonText: 'Activar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        const body = new FormData();
        body.append('usu_id', id);

        const url = `/devjobs/API/activacion/activar`;
        const config = {
            method: 'POST',
            body,
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data);
            const { codigo, mensaje, detalle } = data;

            switch (codigo) {
                case 1:
                    buscar();
                    Swal.fire({
                        icon: 'success',
                        title: 'Activado Exitosamente',
                        text: mensaje,
                        confirmButtonText: 'OK'
                    });
                    break;
                    case 2:
                        buscar();
                        Swal.fire({
                            icon: 'info',
                            title: 'No se puede activar el usuario sin un rol asignado',
                            text: mensaje,
                            confirmButtonText: 'OK'
                        });
                    break;
                case 0:
                    console.log(detalle);
                    break;
                default:
                    break;
            }

        } catch (error) {
            console.log(error);
        }
    }
};




// //!Funcion Eliminar
const eliminar = async e => {
    const result = await Swal.fire({
        icon: 'question',
        title: 'Eliminar Usuario',
        text: '¿Desea eliminar esta Solicituda?',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    });
    
    const button = e.target;
    const id = button.dataset.id
    // alert(id);
    
    if (result.isConfirmed) {
        const body = new FormData();
        body.append('usu_id', id);
        
        const url = `/devjobs/API/activacion/eliminar`;
        const config = {
            method: 'POST',
            body,
        };
        
        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data);
            const { codigo, mensaje, detalle } = data;

            let icon='info'
            switch (codigo) {
                case 1:
                    buscar();
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado Exitosamente',
                        text: mensaje,
                        confirmButtonText: 'OK'
                    });
                    break;
                    case 0:
                        console.log(detalle);
                        break;
                default:
                    break;
            }

        } catch (error) {
            console.log(error);
        }
    }
};

const mostrarFormulario = () => {
    tablaUsuariosContainer.style.display = 'none';
    formulario.style.display = 'block';
};

const ocultarFormulario = () => {
    formulario.reset();
    formulario.style.display = 'none';
    tablaUsuariosContainer.style.display = 'block';
};


//!Para colocar los datos sobre el formulario
const traeDatos = (e) => {
    const button = e.target;
    const id = button.dataset.id;
    const nombre = button.dataset.nombre;
    const catalogo = button.dataset.catalogo;

    //! Llenar el formulario con los datos obtenidos
    formulario.usu_id.value = id;
    formulario.usu_nombre.value = nombre;
    formulario.usu_catalogo.value = catalogo;
}

//!Aca esta la funcino de cancelar la accion de modificar un registro.
const cancelarAccion = () => {
    formulario.reset();
    document.getElementById('tablaUsuariosContainer').style.display = 'block'; // Corrección aquí
};

//!Aca esta la funcion de modificar un registro
const asignarol = async () => {
    const usu_id = formulario.usu_id.value;
    const body = new FormData(formulario);
    body.append('usu_id', usu_id);

    const url = `/devjobs/API/activacion/asignarol`;
    const config = {
        method: 'POST',
        body,
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        const { codigo, mensaje, detalle } = data;

        switch (codigo) {
            case 1:
                formulario.reset();
                cancelarAccion(); // Corrección aquí
                buscar();

                
                ocultarFormulario(); // Ocultar el formulario
                
                Toast.fire({
                    icon: 'success',
                    title: 'Rol Asignado',
                    text: mensaje,
                    confirmButtonText: 'OK'
                });
                break;
            case 0:
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Verifique sus datos: ' + mensaje,
                    confirmButtonText: 'OK'
                });
                break;
            default:
                break;
        }

    } catch (error) {
        console.log(error);
    }
};

datatable.on('click', '.btn-warning', () => {
    mostrarFormulario();
    traeDatos(event);
});


btnCancelar.addEventListener('click', ocultarFormulario);
btnAsignarRol.addEventListener('click', asignarol);
btnCancelar.addEventListener('click', cancelarAccion);
datatable.on('click','.btn-warning', traeDatos)
datatable.on('click','.btn-info', activar)
datatable.on('click','.btn-danger', eliminar)
buscar();





