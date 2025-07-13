<?php

require_once 'clases/clsActividades.php';
require_once 'clases/clsTipoActividades.php';

$actividad = new Actividad(-1, '', '', '');
$tipoactividad = new TipoActividad(-1, '', '');

if (isset($_POST['ingresar_actividad'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_idtipoactividad = mysqli_real_escape_string($con, $_POST['add_idtipoactividad'] ?? '');
    $add_descripcion = mysqli_real_escape_string($con, $_POST['add_descripcion'] ?? '');

    $actividad = new Actividad(0, $add_nombre, $add_idtipoactividad, $add_descripcion);
    $res = $actividad->Registro($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Actividad registrada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=actividades" />  ';
    } else {
        AlertaError('<b>Error al registrar actividad</b>');
    }
} else if (isset($_POST['modificar_actividad'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $idtipoactividad = mysqli_real_escape_string($con, $_POST['idtipoactividad'] ?? '');
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion'] ?? '');
    $id = $_POST['id'];

    $actividad = new Actividad($id, $nombre, $idtipoactividad, $descripcion);
    $res = $actividad->Modificar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Actividad modificada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=actividades" />  ';
    } else {
        AlertaError('<b>Error al modificar actividad</b>');
    }
} else if (isset($_POST['eliminar_actividad'])) {
    $id = $_POST['delete_id'];

    $actividad = new Actividad($id, '', '', '');
    $res = $actividad->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Actividad eliminada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=actividades" />  ';
    } else {
        AlertaError('<b>Error al eliminar actividad</b>');
    }
}

$res = $actividad->Consultar($con);
$resTipo = $tipoactividad->Consultar($con);
$resTipoM = $tipoactividad->Consultar($con);

require 'views/actividades.view.php';
