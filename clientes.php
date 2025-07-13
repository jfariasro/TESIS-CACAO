<?php

require_once 'clases/clsClientes.php';
require_once 'clases/clsValidaciones.php';

$cliente = new Cliente(-1, '', '', '', '');

if (isset($_POST['ingresar_cliente'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_email = mysqli_real_escape_string($con, $_POST['add_email'] ?? '');
    $add_direccion = mysqli_real_escape_string($con, $_POST['add_direccion'] ?? '');
    $add_cedula = mysqli_real_escape_string($con, $_POST['add_cedula'] ?? '');

    $mensaje = Validaciones::ValidarCedula($add_cedula);

    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $cliente = new Cliente(0, $add_nombre, $add_cedula, $add_email, $add_direccion);
        $res = $cliente->Registro($con);
        if ($res) {
            $_SESSION['mensaje'] = "<b>Cliente registrado exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes" />  ';
        } else {
            AlertaError('<b>Error al registrar cliente</b>');
        }
    }
} else if (isset($_POST['modificar_cliente'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $cedula = mysqli_real_escape_string($con, $_POST['cedula'] ?? '');
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $direccion = mysqli_real_escape_string($con, $_POST['direccion'] ?? '');
    $id = $_POST['id'];

    $mensaje = Validaciones::ValidarCedula($cedula);

    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $cliente = new Cliente($id, $nombre, $cedula, $email, $direccion);

        $res = $cliente->Modificar($con);
        if ($res) {
            $_SESSION['mensaje'] = "<b>Cliente modificado exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes" />  ';
        } else {
            AlertaError('<b>Error al modificar cliente</b>');
        }
    }
} else if (isset($_POST['eliminar_cliente'])) {
    $id = $_POST['delete_id'];

    $cliente = new Cliente($id, '', '', '', '');
    $res = $cliente->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Cliente eliminado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes" />  ';
    } else {
        AlertaError('<b>Error al eliminar cliente</b>');
    }
}

$res = $cliente->Consultar($con);

require 'views/clientes.view.php';
