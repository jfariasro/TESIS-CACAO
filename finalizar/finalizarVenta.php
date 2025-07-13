<?php
require_once "config/conexion.php";
$conexion = new Conexion();
$con = $conexion->getConectar();

$codigo = $_SESSION['codigoVenta'];

date_default_timezone_set('America/Guayaquil');
$fechaActual = new DateTime();
$fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
$query = "UPDATE ventas SET fecha = '$fechaFormateada' WHERE codigo = '$codigo'";
$resModificar = mysqli_query($con, $query);

$query = "SELECT cantidad, idplanta, total from ventas WHERE codigo = '$codigo';";
$res = mysqli_query($con, $query);

$total = 0;

while ($row = mysqli_fetch_assoc($res)) {
    $idplanta = $row['idplanta'];
    $cantidad = $row['cantidad'];
    $query = "UPDATE plantas set existencia = existencia - '$cantidad' WHERE id = '$idplanta'";
    $resP = mysqli_query($con, $query);
    $total += $row['total'];
}

require_once 'clases/clsFlujoCaja.php';
require_once 'clases/clsMovimientos.php';

$flujocaja = new FlujoCaja();
$movimiento = new Movimiento(0, '', '', 0);

$parcial = $flujocaja->ConsultarTotal($con);
$parcial += $total;

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
$flujocaja->idmovimiento = $movimiento->ObtenerMovimientoEspecifico($con, 'Venta');
$flujocaja->fecha = $fechaFormateada;
$flujocaja->entrada = $total;
$flujocaja->salida = 0;
$flujocaja->parcial = $parcial;

$res = $flujocaja->Agregar($con);
if ($res) {
    $flujocaja->ModificarCaja($con, $parcial, $idcaja);
}

$_SESSION['exito'] = 'ok';
echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=ventas" />  ';
