import { Toast } from "bootstrap";
import Chart from "chart.js/auto";

const canvas = document.getElementById('chartRoles')
const btnActualizar = document.getElementById('btnActualizar')
const context = canvas.getContext('2d');

const getRandomColor = () => {
    const r = Math.floor(Math.random() * 256)
    const g = Math.floor(Math.random() * 256)
    const b = Math.floor(Math.random() * 256)

    const rgColor = `rgba(${r},${g},${b},0.5)`
    return rgColor
}

const chartRoles  = new Chart(context, {
    type : 'bar',
    data : {
        labels : [],
        datasets : [
            {
                label : 'Roles',
                data : [],
                backgroundColor : []
            }
        ]
    }
})

const getEstadisticas = async () => {
    const url = `/devjobs/API/reporte/estadistica`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

            chartRoles.data.labels = [];
            chartRoles.data.datasets[0].data = [];
            chartRoles.data.datasets[0].backgroundColor = [];

        if(data){
            data.forEach(registro => {
                chartRoles.data.labels.push(registro.rol_nombre)
                chartRoles.data.datasets[0].data.push(registro.cantidad_usuarios)
                chartRoles.data.datasets[0].backgroundColor.push(getRandomColor())
            });
        }else{
            Toast.fire({
                title : 'No se encontraron Registros',
                icon : 'info'
            })
        }
        
        chartRoles.update();

    } catch (error) {
        console.log(error);
    }
}

getEstadisticas();
btnActualizar.addEventListener('click', getEstadisticas)
