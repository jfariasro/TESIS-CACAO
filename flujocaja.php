<?php

use Dompdf\Renderer\AbstractRenderer;

require_once 'clases/clsFlujoCaja.php';
require_once 'clases/clsMovimientos.php';

$flujocaja = new FlujoCaja();
$movimiento = new Movimiento(-1, '', '', -1);

$_SESSION['codigoCaja'] = $flujocaja->ConsultarIdEstado($con);

if (isset($_POST['agregar_entrada']) || isset($_POST['agregar_salida'])) {
    if ($_SESSION['codigoCaja'] == '') {
        $_SESSION['codigoCaja'] = $flujocaja->AbrirCaja($con);
    }
    $idcaja = $_SESSION['codigoCaja'];
    $idmovimientos = mysqli_real_escape_string($con, $_POST['add_idmovimientos']);
    $entrada = mysqli_real_escape_string($con, $_POST['add_entrada'] ?? '');
    $salida = mysqli_real_escape_string($con, $_POST['add_salida'] ?? '');

    $parcial = $flujocaja->ConsultarTotal($con);

    if ($entrada !== '') {
        $entrada = $_POST['add_entrada'];
        $parcial += $entrada;
        $salida = 0;
    } else if ($salida !== '') {
        $salida = $_POST['add_salida'];
        $parcial -= $salida;
        $entrada = 0;
    }


    $contador = $flujocaja->ContarFlujoCaja($con, $idcaja);
    if ($idmovimientos == '2' && $contador == 0) {
        $_SESSION['error'] = "<b>No puedes cerrar caja en este momento</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=flujocaja" />  ';
    } else {
        if ($idmovimientos !== '1' && $_SESSION['codigoCaja'] == '') {
            $flujocaja->AbrirFlujoCaja($con, $_SESSION['codigoCaja'], '1');
        } else if ($contador == 0 && $idcaja !== '') {
            $flujocaja->AbrirFlujoCaja($con, $_SESSION['codigoCaja'], '1');
        }

        date_default_timezone_set('America/Guayaquil');
        $fechaActual = new DateTime();
        $fechaFormateada = $fechaActual->format('Y-m-d H:i:s');

        $flujocaja->idcaja = $idcaja;
        $flujocaja->idmovimiento = $idmovimientos;
        $flujocaja->fecha = $fechaFormateada;
        $flujocaja->entrada = $entrada;
        $flujocaja->salida = $salida;
        $flujocaja->parcial = $parcial;

        $res = $flujocaja->Agregar($con);
        if ($res) {
            $flujocaja->ModificarCaja($con, $parcial, $idcaja);
            $_SESSION['mensaje'] = "<b>Flujo de Caja Registrado Exitosamente</b>";

            if ($idmovimientos == '2') {
                $res = $flujocaja->CerrarCaja($con);
                if ($res) {
                    $_SESSION['mensaje'] = "<b>Caja Cerrada Exitosamente</b>";
                }
            }

            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=flujocaja" />  ';
        } else {
            AlertaError('<b>Error al registrar flujo de caja</b>');
        }
    }
}

$res = $flujocaja->Consultar($con);
$resMovimiento = $movimiento->ConsultarMovimientoTipo1($con);
$resMovimiento2 = $movimiento->ConsultarMovimientoTipo2($con);

require 'views/flujocaja.view.php';
