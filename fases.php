<?php

require_once 'clases/clsFases.php';

$fase = new Fase(-1, '', '');

if (isset($_POST['ingresar_fase'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_descripcion = mysqli_real_escape_string($con, $_POST['add_descripcion'] ?? '');

    $fase = new Fase(0, $add_nombre, $add_descripcion);
    
    $fase_total = $fase->ContarFases($con);

    if ($fase_total['total'] < 5) {
        $res = $fase->Registro($con);
        if ($res) {
            $_SESSION['mensaje'] = "<b>Fase registrada exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=fases" />  ';
        } else {
            AlertaError('<b>Error al registrar fase</b>');
        }
    }else{
        AlertaAdvertencia('<b>No puede haber más de 5 fases de Producción</b>');
    }
} else if (isset($_POST['modificar_fase'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion'] ?? '');
    $id = $_POST['id'];

    $fase = new Fase($id, $nombre, $descripcion);
    $res = $fase->Modificar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Fase modificada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=fases" />  ';
    } else {
        AlertaError('<b>Error al modificar fase</b>');
    }
} else if (isset($_POST['eliminar_fase'])) {
    $id = $_POST['delete_id'];

    $fase = new Fase($id, '', '');
    $res = $fase->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Fase eliminada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=fases" />  ';
    } else {
        AlertaError('<b>Error al eliminar fase</b>');
    }
}

$res = $fase->Consultar($con);

require 'views/fases.view.php';
