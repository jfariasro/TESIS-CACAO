<?php
require_once 'clases/clsCompras.php';

if (isset($_SESSION['exito']) && $_SESSION['exito'] == 'ok') {
    AlertaExitosa("<b>Compra " . $_SESSION['codigoCompra'] . " Generada Exitosamente</b>");
    $_SESSION['codigoCompra'] = '';
    $_SESSION['exito'] = '';
}

$compras = new Compra(-1, 0, 0, 0, 0, 0, '');

$res = $compras->Consultar($con);

require 'views/compras.view.php';