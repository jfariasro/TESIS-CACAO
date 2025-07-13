<?php
require_once "config/conexion.php";
$conexion = new Conexion();
$con = $conexion->getConectar();

$codigo = $_SESSION['codigoCompra'];

date_default_timezone_set('America/Guayaquil');
$fechaActual = new DateTime();
$fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
$query = "UPDATE compras SET fecha = '$fechaFormateada' WHERE codigo = '$codigo'";
$resModificar = mysqli_query($con, $query);

$query = "SELECT cantidad, idinsumo, total from compras WHERE codigo = '$codigo';";
$res = mysqli_query($con, $query);

$total = 0;

while ($row = mysqli_fetch_assoc($res)) {
    $idinsumo = $row['idinsumo'];
    $cantidad = $row['cantidad'];
    $query = "UPDATE insumos set existencia = existencia + '$cantidad' WHERE id = '$idinsumo'";
    $resP = mysqli_query($con, $query);

    $total += $row['total'];
}

require_once 'clases/clsFlujoCaja.php';
require_once 'clases/clsMovimientos.php';

$flujocaja = new FlujoCaja();
$movimiento = new Movimiento(0, '', '', 0);

$parcial = $flujocaja->ConsultarTotal($con);
$parcial -= $total;

$idcaja = $flujocaja->ConsultarIdEstado($con);

if ($idcaja == '') {
    $idcaja = $flujocaja->AbrirCaja($con);
}

$contador = $flujocaja->ContarFlujoCaja($con, $idcaja);

if ($contador == 0) {
    $flujocaja->AbrirFlujoCaja($con, $idcaja, '1');
}

date_default_timezone_set('America/Guayaquil');
$fechaActual = new DateTime();
$fechaFormateada = $fechaActual->format('Y-m-d H:i:s');

$flujocaja->idcaja = $idcaja;
$flujocaja->idmovimiento = $movimiento->ObtenerMovimientoEspecifico($con, 'Compra');
$flujocaja->fecha = $fechaFormateada;
$flujocaja->entrada = 0;
$flujocaja->salida = $total;
$flujocaja->parcial = $parcial;

$res = $flujocaja->Agregar($con);
if ($res) {
    $flujocaja->ModificarCaja($con, $parcial, $idcaja);
}

$_SESSION['exito'] = 'ok';
echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=compras" />  ';
