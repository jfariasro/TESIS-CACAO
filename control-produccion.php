<?php
require_once 'clases/clsProduccion.php';

$produccion = new Produccion();

if (isset($_POST['siguiente_fase'])) {
    $idfase = $_POST['idfase'];
    $idproduccion = $_POST['id'];

    $idfase++;
    $modificar = "UPDATE produccion SET idfase = '$idfase' WHERE id = '$idproduccion';";
    $res = mysqli_query($con, $modificar);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Producción a la siguiente fase</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion&codigoProduccion='.$idproduccion.'" />  ';
    } else {
        AlertaError('<b>No se pudo pasar a la siguiente fase</b>');
    }
} else if (isset($_POST['finalizar_produccion'])) {
    $idfase = $_POST['idfase2'];
    $produccion->idproduccion = $_POST['id2'];
    $res = $produccion->FinalizarProduccion($con);
    
    if ($res) {
        $resultado = $produccion->ModificarPlantaCantidad($con);
        $_SESSION['mensaje'] = "<b>Producción finalizada con éxito</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=control-produccion" />  ';
    } else {
        AlertaError('<b>Producción no finalizada</b>');
    }
}

$res = $produccion->ConsultarProduccion($con);

require 'views/control-produccion.view.php';
