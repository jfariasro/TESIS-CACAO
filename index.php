<?php
session_start();

$tiempoBloqueo = (4 * 60); //4 minutos
$advertencia = '';

if (isset($_SESSION['idInicio'])) {
    echo '<meta http-equiv="refresh" content="0; url=panel.php" />';
    exit;
}

if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

require_once 'config/conexion.php';
require_once 'clases/clsUsuarios.php';
require 'funciones.php';

if (isset($_REQUEST['login'])) {
    if ($_SESSION['intentos'] >= 3) {
        if (isset($_SESSION['tiempoBloqueo']) && time() < $_SESSION['tiempoBloqueo']) {
            $actual = time();
            $tiempo = $_SESSION['tiempoBloqueo'];
            $contador = ceil(($tiempo - $actual) / 60);
            $error = "<b>Demasiados intentos. Intenta de nuevo después de " . $contador . " minutos.</b>";
        } else {
            $_SESSION['intentos'] = 0;
        }
    }

    if ($_SESSION['intentos'] < 3) {
        $conexion = new Conexion();
        $con = $conexion->getConectar();

        $email = mysqli_real_escape_string($con, $_REQUEST['email'] ?? '');
        $password = mysqli_real_escape_string($con, $_REQUEST['pass'] ?? '');

        $usuario = new Usuario(0, '', '', $email, $password);
        $mensaje = $usuario->ValidacionLogin();

        if ($mensaje !== '') {
            $error = $mensaje;
        } else {
            $row = $usuario->InicioSesion($con);

            if ($row && !empty($row)) {
                $seguridad = $usuario->getSeguridad();
                $verificado = password_verify($seguridad, $row['pass']);

                if (!$verificado) {
                    $error = '<b>Error al ingresar los datos del usuario. Intento #' . ($_SESSION['intentos'] + 1) . '.</b>';
                    $_SESSION['intentos']++;
                    if ($_SESSION['intentos'] >= 3) {
                        $_SESSION['tiempoBloqueo'] = time() + $tiempoBloqueo; // Establecer el tiempo de bloqueo
                    }
                } else {
                    $_SESSION['idInicio'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['mensaje'] = '';
                    $_SESSION['error'] = '';
                    $_SESSION['codigoCompra'] = '';
                    $_SESSION['codigoActividadProduccion'] = '';
                    $_SESSION['codigoProduccion'] = '';
                    $_SESSION['codigoVenta'] = '';
                    $_SESSION['codigoCaja'] = '';
                    $_SESSION['codigoActividad'] = '';
                    $_SESSION['exito'] = '';
                    unset($_SESSION['intentos']);
                    unset($_SESSION['tiempoBloqueo']);

                    header('Location: panel.php'); // Redirigir al panel después del inicio de sesión exitoso
                    exit;
                }
            } else {
                $error = '<b>Error al ingresar los datos del usuario. Intento #' . ($_SESSION['intentos'] + 1) . '.</b>';
                $_SESSION['intentos']++;
                if ($_SESSION['intentos'] >= 3) {
                    $_SESSION['tiempoBloqueo'] = time() + $tiempoBloqueo; // Establecer el tiempo de bloqueo
                }
            }
        }
    }
}

// Resto del código para mostrar la vista de inicio de sesión
require 'views/index.view.php';
