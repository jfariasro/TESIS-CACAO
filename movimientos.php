<?php

require_once 'clases/clsMovimientos.php';

$movimiento = new Movimiento(-1, '', '', -1);

if (isset($_POST['ingresar_movimiento'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_descripcion = mysqli_real_escape_string($con, $_POST['add_descripcion'] ?? '');
    $add_idtipo = mysqli_real_escape_string($con, $_POST['add_idtipo'] ?? '');

    $movimiento = new Movimiento(0, $add_nombre, $add_descripcion, $add_idtipo);
    $res = $movimiento->Registro($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Movimiento registrado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=movimientos" />  ';
    } else {
        AlertaError('<b>Error al registrar movimiento</b>');
    }
} else if (isset($_POST['modificar_movimiento'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion'] ?? '');
    $idtipo = mysqli_real_escape_string($con, $_POST['idtipo'] ?? '');
    $id = $_POST['id'];

    $movimiento = new Movimiento($id, $nombre, $descripcion, $idtipo);
    $res = $movimiento->Modificar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Movimiento modificado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=movimientos" />  ';
    } else {
        AlertaError('<b>Error al modificar movimiento</b>');
    }
} else if (isset($_POST['eliminar_movimiento'])) {
    $id = $_POST['delete_id'];

    $movimiento = new Movimiento($id, '', '', -1);
    $res = $movimiento->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Movimiento eliminado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=movimientos" />  ';
    } else {
        AlertaError('<b>Error al eliminar movimiento</b>');
    }
}

$res = $movimiento->Consultar($con);

$resTipo1 = $movimiento->ConsultarTipo($con);
$resTipo2 = $movimiento->ConsultarTipo($con);

require 'views/movimientos.view.php';
