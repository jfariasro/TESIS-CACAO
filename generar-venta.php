<?php

require_once 'clases/clsVentas.php';
require_once 'clases/clsPlantas.php';
require_once 'clases/clsClientes.php';

//$_SESSION['codigoVenta'] = '';

$ventas = new Venta(-1, 0, 0, 0, 0, 0, $_SESSION['codigoVenta'] ?? '');

if (isset($_POST['delete_venta'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_id'] ?? '');
    $query = "DELETE from ventas where id='$id';";
    $res = mysqli_query($con, $query);
    if ($res) {
        $codigo = mysqli_real_escape_string($con, $_POST['delete_codigo'] ?? '');
        $query = "SELECT count(*) as total from ventas where codigo = '$codigo';";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);

        $idcliente = $ventas->ObtenerIdCliente($con);

        if ($row['total'] == 0) {
            $_SESSION['mensaje'] = '<b>Ventas Eliminadas</b>';
            $_SESSION['codigoVenta'] = '';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-venta" />  ';
        } else {
            AlertaExitosa('<b>Venta Borrada Exitosamente</b>');
        }
    } else {
        AlertaError('<b>Error al borrar la Venta</b>');
    }
} else if (isset($_POST['Guardar'])) {
    $idplanta = $_POST['idplanta'];

    if ($_SESSION['codigoVenta'] == '') {
        $idcliente = $_POST['idcliente'];
    } else {
        $ventas = new Venta(-1, 0, 0, 0, 0, 0, $_SESSION['codigoVenta']);
        $idcliente = $compras->ObtenerIdCliente($con);
    }

    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $mensaje = '';

    if ($cantidad <= 0) {
        $mensaje .= '<b>La cantidad debe ser mayor a 0</b><br>';
    }
    if ($precio <= 0) {
        $mensaje .= '<b>El precio debe ser mayor a 0</b>';
    }
    
    $plantas = new Planta($idplanta, '', 0, 0, '');
    $existencia = $plantas->ObtenerExistencia($con);

    if($existencia < $cantidad){
        $mensaje .= '<b>La cantidad a vender no debe ser mayor a la existencia</b>';
    }
    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $total = $precio * $cantidad;

        if ($_SESSION['codigoVenta'] !== '') {
            $ventas = new Venta(-1, $idcliente, $idplanta, $precio, $cantidad, $total, $_SESSION['codigoVenta']);
        } else {
            $ventas = new Venta(-1, $idcliente, $idplanta, $precio, $cantidad, $total, '');
        }

        $resInsertar = $ventas->Registro($con);
        if ($resInsertar) {
            if ($_SESSION['codigoVenta'] == '') {
                $obtenerid = mysqli_insert_id($con);
                $_SESSION['codigoVenta'] =  $obtenerid . '' . $_SESSION['idInicio'];
                $codigo = $_SESSION['codigoVenta'];

                $query = "UPDATE ventas set codigo = $codigo where id = '" . $obtenerid . "';";
                $resModificar = mysqli_query($con, $query);
            }
            $_SESSION['mensaje'] = '<b>Venta generada exitosamente</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-venta" />  ';
        } else {
            $_SESSION['error'] = '<b>Venta no pudo ser generada</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-venta" />  ';
        }
    }
}

$codigo = $_SESSION['codigoVenta'] ?? '';
$resVenta = $ventas->ConsultarVentaGenerada($con);

$consulta = "SELECT p.id, p.nombre FROM plantas p
WHERE p.id NOT IN (
  SELECT v.idplanta
  FROM ventas v
  WHERE v.codigo = '$codigo'
)";
$resPlanta = mysqli_query($con, $consulta);

$cliente = new Cliente(-1, '', '', '', '');
$resCliente = $cliente->Consultar($con);

require 'views/generar-venta.view.php';
