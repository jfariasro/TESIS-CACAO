<?php

require_once 'clases/clsInsumos.php';

$insumo = new Insumo(-1, '', 0, 0, '');

if (isset($_POST['ingresar_insumo'])) {
    $check = @getimagesize($_FILES['add_imagen']['tmp_name']);
    if ($check !== false) {
        $carpeta_destino = 'upload/';
        $archivo_subido = $carpeta_destino . $_FILES['add_imagen']['name'];
        move_uploaded_file($_FILES['add_imagen']['tmp_name'], $archivo_subido);

        $nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
        $precio = mysqli_real_escape_string($con, $_POST['add_precio'] ?? '');
        $existencia = mysqli_real_escape_string($con, $_POST['add_existencia'] ?? '');
        $imagen = $_FILES['add_imagen']['name'];

        if ($precio <= 0) {
            AlertaAdvertencia('<b>Precio debe ser mayor a 0</b>');
        } else {
            $insumo = new Insumo(-1, $nombre, $precio, $existencia, $imagen);

            $res = $insumo->Registro($con);

            if ($res) {
                $_SESSION['mensaje'] = "<b>Insumo registrado exitosamente</b>";
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=insumos" />  ';
            } else {
                AlertaError('<b>Error al registrar insumo</b>');
            }
        }
    } else {
        AlertaError('<b>El archivo no es una imagen o es muy pesado</b>');
    }
} else if (isset($_POST['modificar_insumo'])) {
    if (!$_FILES['imagen']['name']) {
        $check = true;
    } else {
        $check = @getimagesize($_FILES['imagen']['tmp_name']);
    }

    if ($check !== false) {
        $carpeta_destino = 'upload/';
        $archivo_subido = $carpeta_destino . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $archivo_subido);

        $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
        $precio = mysqli_real_escape_string($con, $_REQUEST['precio'] ?? '');
        $existencia = mysqli_real_escape_string($con, $_REQUEST['existencia'] ?? '');
        $imagen = $_FILES['imagen']['name'] ?? false;
        $id = $_POST['id'];

        if ($precio <= 0) {
            AlertaAdvertencia('<b>Precio debe ser mayor a 0</b>');
        } else {
            $insumo = new Insumo($id, $nombre, $precio, $existencia, $imagen);
            $res = $insumo->Modificar($con);

            if ($res) {
                $_SESSION['mensaje'] = "<b>Insumo modificado exitosamente</b>";
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=insumos" />  ';
            } else {
                AlertaError('<b>Error al modificar insumos</b>');
            }
        }
    } else {
        AlertaError('<b>El archivo no es una imagen o es muy pesado</b>');
    }
} else if (isset($_POST['eliminar_insumo'])) {
    $id = $_POST['delete_id'];

    $insumo = new Insumo($id, '', 0, 0, '');
    $res = $insumo->Eliminar($con);

    if ($res) {
        $_SESSION['mensaje'] = "<b>Insumo eliminado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=insumos" />  ';
    } else {
        AlertaError('<b>Error al eliminar insumo</b>');
    }
}

$res = $insumo->Consultar($con);

require 'views/insumos.view.php';
