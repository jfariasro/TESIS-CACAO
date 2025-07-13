<?php

require_once 'clases/clsProveedores.php';
require_once 'clases/clsValidaciones.php';

$proveedor = new Proveedor(-1, '', '', '', '');

if (isset($_POST['ingresar_proveedor'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_cedula = mysqli_real_escape_string($con, $_POST['add_cedula'] ?? '');
    $add_email = mysqli_real_escape_string($con, $_POST['add_email'] ?? '');
    $add_direccion = mysqli_real_escape_string($con, $_POST['add_direccion'] ?? '');

    $mensaje = Validaciones::ValidarCedula($add_cedula);

    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $proveedor = new Proveedor(0, $add_nombre, $add_cedula, $add_email, $add_direccion);
        $res = $proveedor->Registro($con);
        if ($res) {
            $_SESSION['mensaje'] = "<b>Proveedor registrado exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=proveedores" />  ';
        } else {
            AlertaError('<b>Error al registrar proveedor</b>');
        }
    }
} else if (isset($_POST['modificar_proveedor'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $cedula = mysqli_real_escape_string($con, $_POST['cedula'] ?? '');
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $direccion = mysqli_real_escape_string($con, $_POST['direccion'] ?? '');
    $id = $_POST['id'];

    $mensaje = Validaciones::ValidarCedula($cedula);

    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $proveedor = new Proveedor($id, $nombre, $cedula, $email, $direccion);

        $res = $proveedor->Modificar($con);
        if ($res) {
            $_SESSION['mensaje'] = "<b>Proveedor modificado exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=proveedores" />  ';
        } else {
            AlertaError('<b>Error al modificar proveedor</b>');
        }
    }
} else if (isset($_POST['eliminar_proveedor'])) {
    $id = $_POST['delete_id'];

    $proveedor = new Proveedor($id, '', '', '', '');
    $res = $proveedor->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Proveedor eliminado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=proveedores" />  ';
    } else {
        AlertaError('<b>Error al eliminar proveedor</b>');
    }
}

$res = $proveedor->Consultar($con);

require 'views/proveedores.view.php';
