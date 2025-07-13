<?php

require_once 'clases/clsCompras.php';
require_once 'clases/clsInsumos.php';
require_once 'clases/clsProveedores.php';

//$_SESSION['codigoCompra'] = '';

$compras = new Compra(-1, 0, 0, 0, 0, 0, $_SESSION['codigoCompra'] ?? '');

if (isset($_POST['delete_compra'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_id'] ?? '');
    $query = "DELETE from compras where id='$id';";
    $res = mysqli_query($con, $query);
    if ($res) {
        $codigo = mysqli_real_escape_string($con, $_POST['delete_codigo'] ?? '');
        $query = "SELECT count(*) as total from compras where codigo = '$codigo';";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);

        $idproveedor = $compras->ObtenerIdProveedor($con);

        if ($row['total'] == 0) {
            $_SESSION['mensaje'] = '<b>Compras Eliminadas</b>';
            $_SESSION['codigoCompra'] = '';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-compra" />  ';
        } else {
            AlertaExitosa('<b>Compra Borrada Exitosamente</b>');
        }
    } else {
        AlertaError('<b>Error al borrar la Compra</b>');
    }
} else if (isset($_POST['Guardar'])) {
    $idinsumo = $_POST['idinsumo'];

    if ($_SESSION['codigoCompra'] == '') {
        $idproveedor = $_POST['idproveedor'];
    } else {
        $compras = new Compra(-1, 0, 0, 0, 0, 0, $_SESSION['codigoCompra']);
        $idproveedor = $compras->ObtenerIdProveedor($con);
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
    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $total = $precio * $cantidad;

        $compras = new Compra(-1, $idproveedor, $idinsumo, $precio, $cantidad, $total, $_SESSION['codigoCompra']);

        $resInsertar = $compras->Registro($con);
        if ($resInsertar) {
            if ($_SESSION['codigoCompra'] == '') {
                $obtenerid = mysqli_insert_id($con);
                $_SESSION['codigoCompra'] =  $obtenerid . '' . $_SESSION['idInicio'];
                $codigo = $_SESSION['codigoCompra'];

                $query = "UPDATE compras set codigo = $codigo where id = '" . $obtenerid . "';";
                $resModificar = mysqli_query($con, $query);
            }
            $_SESSION['mensaje'] = '<b>Compra generada exitosamente</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-compra" />  ';
        } else {
            $_SESSION['error'] = '<b>Compra no pudo ser generada</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-compra" />  ';
        }
    }
} else if (isset($_POST['modificar_compra'])) {
    $id = mysqli_real_escape_string($con, $_POST['id'] ?? '');
    $cantidad = mysqli_real_escape_string($con, $_POST['edit_cantidad'] ?? '');

    $mensaje = '';

    if ($cantidad <= 0) {
        $mensaje .= '<b>La cantidad debe ser mayor a 0</b><br>';
    }
    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $compras = new Compra($id, -1, -1, 0, $cantidad, 0, '');
        $resEditar = $compras->ActualizarCantidadInsumo($con);
        if ($resEditar) {
            $_SESSION['mensaje'] = '<b>Cantidad Actualizada exitosamente</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-compra" />  ';
        } else {
            $_SESSION['error'] = '<b>Cantidad no pudo ser actualizada</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-compra" />  ';
        }
    }
} else if(isset($_POST['agregar_factura'])){
    $codigo = mysqli_real_escape_string($con, $_POST['end_codigo'] ?? '');
    $factura = mysqli_real_escape_string($con, $_POST['end_factura'] ?? '');

    $query = "UPDATE compras SET factura = '$factura' WHERE codigo = '$codigo'";
    $res = mysqli_query($con, $query);

    if($res){
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=finalizar/finalizarCompra" />  ';
    }
}

$codigo = $_SESSION['codigoCompra'] ?? '';
$resCompra = $compras->ConsultarCompraGenerada($con);

if ($codigo != '') {
    $rowDatos = $compras->ObtenerDatosDeCompras($con);
}

$consulta = "SELECT i.id, i.nombre, i.precio, i.imagen, i.existencia FROM insumos i
WHERE i.id NOT IN (
  SELECT c.idinsumo
  FROM compras c
  WHERE c.codigo = '$codigo'
)";
$resInsumo = mysqli_query($con, $consulta);

$proveedor = new Proveedor(-1, '', '', '', '');
$resProveedor = $proveedor->Consultar($con);

if($_SESSION['codigoCompra'] !== ''){
    $idproveedor = $compras->ObtenerIdProveedor($con);
}

require 'views/generar-compra.view.php';
