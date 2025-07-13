<?php

require_once 'clases/clsTipoActividades.php';

$tipoactividad = new TipoActividad(-1, '', '');

if (isset($_POST['ingresar_tipoactividad'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_descripcion = mysqli_real_escape_string($con, $_POST['add_descripcion'] ?? '');

    $tipoactividad = new TipoActividad(0, $add_nombre, $add_descripcion);
    $res = $tipoactividad->Registro($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Tipo de Actividad registrada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=tipoactividades" />  ';
    } else {
        AlertaError('<b>Error al registrar tipo de actividad</b>');
    }
} else if (isset($_POST['modificar_tipoactividad'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion'] ?? '');
    $id = $_POST['id'];

    $tipoactividad = new TipoActividad($id, $nombre, $descripcion);
    $res = $tipoactividad->Modificar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Tipo de Actividad modificada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=tipoactividades" />  ';
    } else {
        AlertaError('<b>Error al modificar tipo de actividad</b>');
    }
} else if (isset($_POST['eliminar_tipoactividad'])) {
    $id = $_POST['delete_id'];

    $tipoactividad = new TipoActividad($id, '', '');
    $res = $tipoactividad->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Tipo de Actividad eliminada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=tipoactividades" />  ';
    } else {
        AlertaError('<b>Error al eliminar tipo de actividad</b>');
    }
}

$res = $tipoactividad->Consultar($con);

require 'views/tipoactividades.view.php';
