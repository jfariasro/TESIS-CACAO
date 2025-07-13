<?php
require_once 'clases/clsVentas.php';

if (isset($_SESSION['exito']) && $_SESSION['exito'] == 'ok') {
    AlertaExitosa("<b>Venta " . $_SESSION['codigoVenta'] . " Generada Exitosamente</b>");
    $_SESSION['codigoVenta'] = '';
    $_SESSION['exito'] = '';
}

$ventas = new Venta(-1, 0, 0, 0, 0, 0, '');

$res = $ventas->Consultar($con);

require 'views/ventas.view.php';
