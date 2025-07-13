<?php
require_once "config/conexion.php";
$conexion = new Conexion();
$con = $conexion->getConectar();

$codigo = $_SESSION['codigoActividad'];

$query = "SELECT COUNT(*) AS total FROM actividad_recurso WHERE idgestionactividad = '$codigo'";
$res = mysqli_query($con, $query);
$row1 = mysqli_fetch_assoc($res);

$query = "SELECT COUNT(*) AS total FROM actividad_trabajador WHERE idgestionactividad = '$codigo'";
$res = mysqli_query($con, $query);
$row2 = mysqli_fetch_assoc($res);

if ($row1['total'] == 0 || $row2['total'] == 0) {
    $_SESSION['error'] = '<b>Debe haber datos de trabajador y recursos en la actividad</b>';
    echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=gestion-actividades" />  ';
} else {
    date_default_timezone_set('America/Guayaquil');
    $fechaActual = new DateTime();
    $fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
    $query = "UPDATE gestion_actividad SET fecha = '$fechaFormateada' WHERE id = '$codigo'";
    $resModificar = mysqli_query($con, $query);

    $query = "SELECT cantidad, idinsumo from actividad_recurso WHERE idgestionactividad = '$codigo';";
    $res = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($res)) {
        $idinsumo = $row['idinsumo'];
        $cantidad = $row['cantidad'];
        $query = "UPDATE insumos set existencia = existencia - '$cantidad' WHERE id = '$idinsumo'";
        $resP = mysqli_query($con, $query);
    }

    $query = "SELECT SUM(costo) AS total FROM actividad_trabajador WHERE idgestionactividad = '$codigo'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);

    $total = $row['total'];

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
    $flujocaja->idmovimiento = $movimiento->ObtenerMovimientoEspecifico($con, 'Actividad o Producción');
    $flujocaja->fecha = $fechaFormateada;
    $flujocaja->entrada = 0;
    $flujocaja->salida = $total;
    $flujocaja->parcial = $parcial;

    $res = $flujocaja->Agregar($con);
    if ($res) {
        $flujocaja->ModificarCaja($con, $parcial, $idcaja);
    }

    $_SESSION['mensaje'] = '<b>Actividad generada de forma exitosa</b>';
    $_SESSION['codigoActividad'] = '';
    echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=gestion-actividades" />  ';
}
