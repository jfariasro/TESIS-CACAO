<?php

require_once 'clases/clsPlantas.php';

$planta = new Planta(-1, '', 0, 0, '');

if (isset($_POST['ingresar_planta'])) {
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
            $planta = new Planta(-1, $nombre, $precio, $existencia, $imagen);

            $res = $planta->Registro($con);

            if ($res) {
                $_SESSION['mensaje'] = "<b>Planta registrada exitosamente</b>";
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=plantas" />  ';
            } else {
                AlertaError('<b>Error al registrar planta</b>');
            }
        }
    } else {
        AlertaError('<b>El archivo no es una imagen o es muy pesado</b>');
    }
} else if (isset($_POST['modificar_planta'])) {
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
            $planta = new Planta($id, $nombre, $precio, $existencia, $imagen);
            $res = $planta->Modificar($con);

            if ($res) {
                $_SESSION['mensaje'] = "<b>Planta modificada exitosamente</b>";
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=plantas" />  ';
            } else {
                AlertaError('<b>Error al modificar plantas</b>');
            }
        }
    } else {
        AlertaError('<b>El archivo no es una imagen o es muy pesado</b>');
    }
} else if (isset($_POST['eliminar_planta'])) {
    $id = $_POST['delete_id'];

    $planta = new Planta($id, '', 0, 0, '');
    $res = $planta->Eliminar($con);

    if ($res) {
        $_SESSION['mensaje'] = "<b>Planta eliminada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=plantas" />  ';
    } else {
        AlertaError('<b>Error al eliminar planta</b>');
    }
}

$res = $planta->Consultar($con);

require 'views/plantas.view.php';
