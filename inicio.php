<?php
// Consulta para obtener datos de ventas
$queryVentas = "SELECT YEAR(fecha) AS Anio, MONTH(fecha) AS Mes, SUM(cantidad * precio) AS V
FROM ventas
WHERE fecha >= DATE_SUB(NOW(), INTERVAL 6 MONTH) AND fecha <= NOW()
GROUP BY Anio, Mes;";
$resultVentas = mysqli_query($con, $queryVentas);

// Consulta para obtener datos de compras
$queryCompras = "SELECT YEAR(fecha) AS Anio, MONTH(fecha) AS Mes, SUM(cantidad * precio) AS C FROM compras
WHERE fecha >= DATE_SUB(NOW(), INTERVAL 6 MONTH) AND fecha <= NOW()
GROUP BY Anio, Mes;";
$resultCompras = mysqli_query($con, $queryCompras);

// Consulta para obtener datos de pago a trabajador
$queryCostoTrabajador = "SELECT YEAR(ga.fecha) AS Anio, MONTH(ga.fecha) AS Mes, SUM(atr.costo) AS C
FROM gestion_actividad ga JOIN actividad_trabajador atr ON atr.idgestionactividad = ga.id
WHERE ga.fecha >= DATE_SUB(NOW(), INTERVAL 6 MONTH) AND ga.fecha <= NOW()
GROUP BY Anio, Mes;";
$resultCostoTrabajador = mysqli_query($con, $queryCostoTrabajador);


// Datos de Ventas
$datosVentas = array();
$datosVentas[] = array('Mes', 'V');
while ($row = mysqli_fetch_assoc($resultVentas)) {
    $nombreMes = DateTime::createFromFormat('!m', $row['Mes'])->format('F'); // Convertir número de mes a nombre
    $datosVentas[] = array($nombreMes, (int)$row['V']);
}

// Datos de Compras
$datosCompras = array();
$datosCompras[] = array('Mes', 'C');
while ($row = mysqli_fetch_assoc($resultCompras)) {
    $nombreMes = DateTime::createFromFormat('!m', $row['Mes'])->format('F'); // Convertir número de mes a nombre
    $datosCompras[] = array($nombreMes, (int)$row['C']);
}

// Datos de Costos
$datosCostos = array();
$datosCostos[] = array('Mes', 'C');
foreach ($resultCostoTrabajador as $row) {
    $nombreMes = DateTime::createFromFormat('!m', $row['Mes'])->format('F'); // Convertir número de mes a nombre
    $datosCostos[] = array($nombreMes, (int)$row['C']);
}


$i = 1;
$datosCompras2 = array();
$datosCompras2 = $datosCompras;
while ($i < count($datosCostos)) {
    $mesCosto = $datosCostos[$i][0];
    $valorCosto = $datosCostos[$i][1];

    $j = $i;
    while ($j < count($datosCompras2)) {
        $mesCompra = $datosCompras2[$j][0];
        $valorCompra = $datosCompras2[$j][1];

        // Comparar los meses
        if ($mesCompra == $mesCosto) {
            // Sumar los valores de C y actualizar en el array de compras
            $datosCompras2[$j][1] = $valorCompra + $valorCosto;
            break;
        }
        $j++;
    }

    $i++;
}

// Datos para el Control Semáforo
$datosSemaforo = array();
$datosSemaforo[] = array('Mes', 'Ventas', 'Costos');
foreach ($datosVentas as $key => $venta) {
    if ($key > 0 && isset($venta[0]) && isset($datosCompras2[$key][1])) {
        $datosSemaforo[] = array($venta[0], $venta[1], $datosCompras2[$key][1]);
    }
}


// Obtener la fecha de hace 7 días
$fechaHace7Dias = date('Y-m-d', strtotime('-7 days'));
// Consulta para obtener el total de ventas en los últimos 7 días
$queryVentasUltimos7Dias = "SELECT SUM(cantidad * precio) AS TotalVentas FROM ventas WHERE fecha >= '$fechaHace7Dias'";
$resultVentasUltimos7Dias = mysqli_query($con, $queryVentasUltimos7Dias);
$totalVentasUltimos7Dias = mysqli_fetch_assoc($resultVentasUltimos7Dias)['TotalVentas'];
// Consulta para obtener el total de compras en los últimos 7 días
$queryComprasUltimos7Dias = "SELECT SUM(cantidad * precio) AS TotalComprasUltimos7Dias FROM compras WHERE fecha >= '$fechaHace7Dias'";
$resultComprasUltimos7Dias = mysqli_query($con, $queryComprasUltimos7Dias);
$totalComprasUltimos7Dias = mysqli_fetch_assoc($resultComprasUltimos7Dias)['TotalComprasUltimos7Dias'];

// Consulta para obtener el total de clientes
$queryTotalClientes = "SELECT COUNT(*) AS TotalClientes FROM clientes";
$resultTotalClientes = mysqli_query($con, $queryTotalClientes);
$totalClientes = mysqli_fetch_assoc($resultTotalClientes)['TotalClientes'];

// Obtener el primer y último día del mes actual
$primerDiaMes = date("Y-m-01");
$ultimoDiaMes = date("Y-m-t");
// Consulta para obtener el total de ventas en el mes actual
$queryVentasMesActual = "SELECT SUM(cantidad * precio) AS TotalVentasMesActual FROM ventas WHERE fecha BETWEEN '$primerDiaMes' AND '$ultimoDiaMes'";
$resultVentasMesActual = mysqli_query($con, $queryVentasMesActual);
$totalVentasMesActual = mysqli_fetch_assoc($resultVentasMesActual)['TotalVentasMesActual'];

// Consulta para obtener el total de proveedores
$queryTotalProveedores = "SELECT COUNT(*) AS TotalProveedores FROM proveedores";
$resultTotalProveedores = mysqli_query($con, $queryTotalProveedores);
$totalProveedores = mysqli_fetch_assoc($resultTotalProveedores)['TotalProveedores'];

// Consulta para obtener el total de trabajadores
$queryTotalTrabajadores = "SELECT COUNT(*) AS TotalTrabajadores FROM trabajadores";
$resultTotalTrabajadores = mysqli_query($con, $queryTotalTrabajadores);
$totalTrabajadores = mysqli_fetch_assoc($resultTotalTrabajadores)['TotalTrabajadores'];

// Consulta para obtener el último total de caja
$queryTotalCaja = "SELECT total FROM caja ORDER BY fecha_fin DESC LIMIT 1";
$resultTotalCaja = mysqli_query($con, $queryTotalCaja);
// Obtener el resultado
$ultimoTotalCaja = 0; // Valor predeterminado si no hay resultados
if ($row = mysqli_fetch_assoc($resultTotalCaja)) {
    $ultimoTotalCaja = (float)$row['total'];
}

// Consulta para obtener el pago trabajador en el mes
$queryTotalPagoTrabajador = "SELECT SUM(costo) AS total FROM actividad_trabajador atr JOIN gestion_actividad ga
ON atr.idgestionactividad = ga.id WHERE ga.fecha BETWEEN '$primerDiaMes' AND '$ultimoDiaMes'";
$resultTotalPagoTrabajador = mysqli_query($con, $queryTotalPagoTrabajador);
// Obtener el resultado
$totalPagoTrabajador = 0; // Valor predeterminado si no hay resultados
if ($row = mysqli_fetch_assoc($resultTotalPagoTrabajador)) {
    $totalPagoTrabajador = (float)$row['total'];
}

//Consulta para el total de producción
$queryTotalProduccion = "SELECT SUM(cantidad) AS total FROM produccion p
WHERE p.fecha_fin BETWEEN '$primerDiaMes' AND '$ultimoDiaMes' AND estado = true";
$resultTotalProduccion = mysqli_query($con, $queryTotalProduccion);
// Obtener el resultado
$totalProduccion = 0; // Valor predeterminado si no hay resultados
if ($row = mysqli_fetch_assoc($resultTotalProduccion)) {
    $totalProduccion = (float)$row['total'];
}

// Liberar resultados
mysqli_free_result($resultVentas);
mysqli_free_result($resultCompras);
mysqli_free_result($resultVentasUltimos7Dias);
mysqli_free_result($resultTotalClientes);
mysqli_free_result($resultVentasMesActual);
mysqli_free_result($resultComprasUltimos7Dias);
mysqli_free_result($resultTotalProveedores);
mysqli_free_result($resultTotalTrabajadores);
mysqli_free_result($resultTotalCaja);
mysqli_free_result($resultTotalPagoTrabajador);
mysqli_free_result($resultTotalProduccion);

// Cerrar conexión
mysqli_close($con);

require 'views/inicio.view.php';
