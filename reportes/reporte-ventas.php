<?php ob_start();

require_once "../config/conexion.php";
require_once "../clases/clsVentas.php";
require_once "../clases/clsClientes.php";

$conexion = new Conexion();
$con = $conexion->getConectar();

$ventas = new Venta(-1, 0, 0, 0, 0, 0, $_REQUEST['codigo']);
$resVentas = $ventas->ConsultarVentaGenerada($con);

$idcliente = $ventas->ObtenerIdCliente($con);
$cliente = new Cliente($idcliente, '', '', '', '');
$rowCliente = $cliente->Buscar($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Listado de Ventas Realizadas</title>
</head>

<body>

    <?php require_once 'vista-cabecera.php'; ?>

    <div class="text-center">
        <p class="h4">Datos del Cliente</p>
        <table style="width: 750px;margin-top: 20px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Cedula</th>
                    <th>Email</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $rowCliente['nombre'] ?>
                    </td>
                    <td>
                        <?php echo $rowCliente['cedula'] ?>
                    </td>
                    <td>
                        <?php echo $rowCliente['email'] ?>
                    </td>
                    <td>
                        <?php echo $rowCliente['direccion'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="text-center">
        <p class="h4">Datos de la Venta</p>
        <table style="width: 750px;margin-top: 30px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Planta</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                while ($row = mysqli_fetch_assoc($resVentas)) {
                    $total = $total + $row['total'];
                    $fecha = $row['fecha'];
                ?>
                    <tr>
                        <td><?php echo $row['planta'] ?></td>
                        <td><?php echo $row['cantidad'] ?></td>
                        <td><?php echo "$" . $row['precio']; ?></td>
                        <td><?php echo "$" . $row['total']; ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    <br>
    <div class="text-right">
        <strong>Total a Pagar: </strong><?php echo "$" . number_format($total, 2); ?>
    </div>

    <div class="text-left">
        <p class="h5">Datos Adicionales</p>
        <strong>Código: </strong><?php echo $_GET['codigo']; ?>
        <br>
        <strong>Fecha: </strong><?php echo date('d/m/Y H:i:s', strtotime($fecha)); ?>
    </div>


</body>

</html>

<?php

$html = ob_get_clean();
//echo $html;

require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->load_html($html);

$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$nombre = "reporte-venta-" . $_GET['codigo'] . ".pdf";
$dompdf->stream($nombre, array("Attachment" => false));
