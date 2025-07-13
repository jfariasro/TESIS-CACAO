<?php ob_start();

require_once "../config/conexion.php";
require_once "../clases/clsFlujoCaja.php";

$conexion = new Conexion();
$con = $conexion->getConectar();

$idcaja = $_REQUEST['codigo'];

$query = "SELECT * FROM caja WHERE estado = true and id = '$idcaja'";
$resCaja = mysqli_query($con, $query);
$rowCaja = mysqli_fetch_assoc($resCaja);

$query = "SELECT m.nombre AS movimiento,
        fc.fecha, fc.entrada, fc.salida, fc.parcial FROM
        flujocaja fc JOIN caja c ON c.id = fc.idcaja
        JOIN movimientos m ON m.id = fc.idmovimientos
        WHERE c.estado = true AND c.id = '$idcaja'
        ORDER BY fc.fecha ASC";
$resFlujo = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Listado de los Movimientos</title>
</head>

<body>

    <?php require_once 'vista-cabecera.php'; ?>

    <div class="text-center">
        <p class="h4">Datos de la Caja</p>
        <table style="width: 750px;margin-top: 20px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Total en Caja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo date('d/m/Y H:i:s', strtotime($rowCaja['fecha_inicio'])); ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y H:i:s', strtotime($rowCaja['fecha_fin'])); ?>
                    </td>
                    <td>
                        <?php echo $rowCaja['total'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="text-center">
        <p class="h4">Flujo de Caja</p>
        <table style="width: 750px;margin-top: 30px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Movimiento</th>
                    <th>Fecha</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Parcial</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($resFlujo)) {
                ?>
                    <tr>
                        <td><?php echo $row['movimiento'] ?></td>
                        <td><?php echo $row['fecha'] ?></td>
                        <td><?php echo "$" . $row['entrada'] ?></td>
                        <td><?php echo "$" . $row['salida']; ?></td>
                        <td><?php echo "$" . $row['parcial']; ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    <br>
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

$nombre = "reporte-compra-" . $_GET['codigo'] . ".pdf";
$dompdf->stream($nombre, array("Attachment" => false));
