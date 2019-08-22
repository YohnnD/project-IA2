var ventasChart = document.querySelector("#ventas");
var ventas = new Chart(ventasChart, {
    type: "line", // Tipo de chart
    data: { // Incluye lo referente a datos
        "labels": [ // Etiquetas para la leyenda
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"
        ],
        "datasets": [{ // Sets de datos que tendra la chart
            "label": "Ventas",
            "data": [65, 59, 80, 81, 56, 92, 40, 0, 0, 0, 0, 0, 0],
            "fill": false,
            "borderColor": "rgb(75, 192, 192)",
            "lineTension": 0.1
        }]
    },
    options: {
        title: {
            display: true,
            text: "Ventas anuales",
            fontSize: 25
        },
        legend: {
            position: 'bottom'
        }
    }
});

var gananciasChart = document.querySelector("#ganancias");
var ganancias = new Chart(gananciasChart, {
    type: "pie",
    data: {
        "labels": ["Enero", "Febrero", "Marzo", "Abril"],
        "datasets": [{
            "label": "Ganancias",
            "data": [40, 20, 55, 70],
            "backgroundColor": [
                "#e91e63",
                "#9c27b0",
                "#4caf50",
                "#03a9f4"
            ]
        }]
    },
    options: {
        title: {
            display: true,
            text: "Ganancias anuales",
            fontSize: 25
        },
        legend: {
            position: "bottom"
        }
    }
});

$(document).ready(function() {
     $('.timer').countTo({
         speed: 2000
     });
});