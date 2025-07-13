
function Grafica(dato, titulo, id) {
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var datos = google.visualization.arrayToDataTable(dato);

        var opciones = {
            title: titulo,
            is3D: true, // Agrega efecto 3D al gráfico
            legend: { position: 'top', alignment: 'center' }, // Posiciona la leyenda en la parte superior y alinea al centro
            backgroundColor: { fill: 'transparent' }, // Fondo transparente
            chartArea: { width: '70%', height: '70%' }, // Ajusta el área del gráfico
            hAxis: { title: 'Fecha' }, // Título del eje horizontal
            vAxis: { title: 'Total' } // Título del eje vertical
        };

        var chart = new google.visualization.ColumnChart(document.getElementById(id));
        chart.draw(datos, opciones);
    }
}


// function getColor(valorv, valorc) {
//     if (valorv < valorc) {
//         return 'rgba(255, 0, 0, 1)'; // Rojo
//     } else if (valorv == valorc) {
//         return 'rgba(255, 255, 0, 1)'; // Amarillo
//     } else {
//         return 'rgba(0, 128, 0, 1)'; // Verde
//     }
// }

// function Graficar(dato) {
//     let coloresVentas = [];
//     let coloresCompras = [];
//     let venta = [];
//     let compra = [];
//     let meses = [];

//     for (var i = 1; i < dato.length; i++) {
//         meses.push(dato[i][0]);
//         venta.push(dato[i][1]);
//         compra.push(dato[i][2]);

//         var colorVentas = getColor(venta[i - 1], compra[i - 1]);
//         coloresVentas.push(colorVentas);

//         // Color fijo para las barras de compras (puedes ajustar esto según tu lógica)
//         coloresCompras.push('rgba(0, 0, 0, 0.7)');
//     }

//     var ctx = document.getElementById('myChart').getContext('2d');
//     var myChart = new Chart(ctx, {
//         type: 'bar',
//         data: {
//             labels: meses,
//             datasets: [{
//                 label: 'Ventas',
//                 data: venta,
//                 backgroundColor: coloresVentas,
//                 borderColor: 'black',
//                 borderWidth: 2
//             },
//             {
//                 label: 'Compras',
//                 data: compra,
//                 backgroundColor: coloresCompras,
//                 borderColor: 'white',
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             scales: {
//                 yAxes: [{
//                     ticks: {
//                         beginAtZero: true,
//                         fontColor: 'black'
//                     }
//                 }]
//             }
//         }
//     });
// }


function getColor(valorv, valorc) {
    if (valorv < valorc) {
        return 'rgba(255, 0, 0, 1)'; // Rojo
    } else if (valorv == valorc) {
        return 'rgba(255, 255, 0, 1)'; // Amarillo
    } else {
        return 'rgba(0, 128, 0, 1)'; // Verde
    }
}

function Graficar(dato) {
    let colores = [];
    let venta = [];
    let compra = [];
    let meses = [];

    console.log(dato[1][1]);

    for (var i = 1; i < dato.length; i++) {
        meses.push(dato[i][0]);
        venta.push(dato[i][1]);
        compra.push(dato[i][2]);

        var color = getColor(venta[i - 1], compra[i - 1]);
        colores.push(color);
    }
    console.log(colores);
    console.log(venta);
    console.log(compra);

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Ventas',
                data: venta,
                backgroundColor: colores,
                borderColor: 'black',
                borderWidth: 2
            },
            {
                label: 'Costos',
                data: compra,
                backgroundColor: 'black',
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontColor: 'black'
                    }
                }]
            }
        }
    });


}

