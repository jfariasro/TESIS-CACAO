<?php
//Conexión a la Base de Datos
require_once "config/conexion.php";
$conexion = new Conexion();
$con = $conexion->getConectar();

$fechaInicio = $_GET['fechaInicio'];
$fechaFin = $_GET['fechaFin'];

$queryComprasVentasPorFecha = "SELECT fecha, SUM(cantidad * precio) AS compras, 0 AS ventas FROM compras WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin' GROUP BY fecha
                             UNION
                             SELECT fecha, 0 AS compras, SUM(cantidad * precio) AS ventas FROM ventas WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin' GROUP BY fecha";
$resultComprasVentasPorFecha = mysqli_query($con, $queryComprasVentasPorFecha);

// Consulta para obtener datos para el gráfico de barras de control productivo
$queryControlProductivo = "SELECT elemento, SUM(cantidad) AS cantidad FROM produccion WHERE fecha_fin BETWEEN '$fechaInicio' AND '$fechaFin' AND estado = true GROUP BY elemento";
$resultControlProductivo = mysqli_query($con, $queryControlProductivo);

// Datos para el gráfico de barras de control productivo
$datosControlProductivo = array();
while ($row = mysqli_fetch_assoc($resultControlProductivo)) {
    $datosControlProductivo[] = $row;
}

// Devuelve los nuevos datos como respuesta JSON
echo json_encode([
    'datosVentas' => $datosVentas,
    'datosCompras' => $datosCompras,
    'datosSemaforo' => $datosSemaforo,
    'datosComprasVentasPorFecha' => $datosComprasVentasPorFecha,
    'datosControlProductivo' => $datosControlProductivo
]);

// Cerrar conexión
mysqli_close($con);
?>
