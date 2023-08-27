import Chart from "chart.js/auto";

const canvas = document.getElementById('chartEstados');
const btnActualizar = document.getElementById('btnActualizar');
const context = canvas.getContext('2d');

const getRandomColor = () => {
    const r = Math.floor(Math.random() * 256)
    const g = Math.floor(Math.random() * 256)
    const b = Math.floor(Math.random() * 256)

    const rgColor = `rgba(${r},${g},${b},0.5)`
    return rgColor
}


const chartEstados = new Chart(context, {
    type: 'bar',
    data: {
        labels: ['Activos', 'Inactivos'],
        datasets: [
            {
                label: 'Estados',
                data: [],
                backgroundColor: []
            }
        ]
    }
});

const getEstadisticas = async () => {
    const url = `/devjobs/API/lista/estadistica`; 
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        console.log("Datos que trae la grafica:", data); 

        if (data) {
            const activosCount = data.filter(registro => registro.estado === 'Activo  ').length;
            const inactivosCount = data.filter(registro => registro.estado === 'Inactivo').length;
            chartEstados.data.datasets[0].backgroundColor.push(getRandomColor())
            updateChart([activosCount, inactivosCount]);
        } else {
            Toast.fire({
                title: 'No se encontraron Registros',
                icon: 'info'
            });
        }
    } catch (error) {
        console.log(error);
    }
};

const updateChart = (data) => {
    chartEstados.data.datasets[0].data = data;
    chartEstados.update();
};

btnActualizar.addEventListener('click', getEstadisticas);
getEstadisticas();  
