<?php ob_start();

require_once "../config/conexion.php";
require_once "../clases/clsGestionActividad.php";
require_once "../clases/clsProveedores.php";
require_once "../clases/clsProduccion.php";

$conexion = new Conexion();
$con = $conexion->getConectar();

$produccion = new Produccion();
$produccion->idproduccion = $_REQUEST['codigo'];
$query = "SELECT p.cantidad, f.nombre as fase, p.id,
p.estado, pl.nombre as planta
from produccion p join fases f on p.idfase = f.id
JOIN plantas pl ON pl.id = p.idplanta
WHERE p.id = '$produccion->idproduccion'";
$resProduccion = mysqli_query($con, $query);
$rowProduccion = mysqli_fetch_assoc($resProduccion);

$query = "SELECT idgestionactividad FROM actividad_produccion WHERE idproduccion = '$produccion->idproduccion'";
$resGestion =  mysqli_query($con, $query);

mysqli_free_result($resProduccion);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Control de Actividad Producción <?php echo $_REQUEST['codigo']; ?></title>
</head>

<body>

    <?php require_once 'vista-cabecera.php'; ?>

    <div class="text-center">
        <p class="h4">Datos de la Producción</p>
        <table style="width: 750px;margin-top: 20px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Fase</th>
                    <th>Planta</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $rowProduccion['cantidad'] ?>
                    </td>
                    <td>
                        <?php echo $rowProduccion['fase'] ?>
                    </td>
                    <td>
                        <?php echo $rowProduccion['planta'] ?>
                    </td>
                    <td>
                        <?php echo (!$rowProduccion['estado']) ? "En Proceso" : "Finalizado" ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <?php while ($rowGestion = mysqli_fetch_assoc($resGestion)) : ?>
        <?php
        $gestion = new GestionActividad();
        $gestion->idgestionactividad = $rowGestion['idgestionactividad'];

        $rowConsulta = $gestion->ConsultarGestion($con);

        $resRecurso = $gestion->ConsultarGestionRecurso($con);
        $resTrabajador = $gestion->ConsultarGestionTrabajador($con);
        ?>
        <div class="text-center">
            <p class="h4">Datos de la Actividad <?php echo $gestion->idgestionactividad; ?></p>
            <table style="width: 750px;margin-top: 20px;" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Actividad</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo date('d/m/Y H:i:s', strtotime($rowConsulta['fecha'])); ?>
                        </td>
                        <td>
                            <?php echo $rowConsulta['actividad'] ?>
                        </td>
                        <td>
                            <?php echo $rowConsulta['tipo'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>

        <div class="text-center">
            <p class="h4">Datos de los Recursos</p>
            <table style="width: 750px;margin-top: 30px;" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Insumo</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($resRecurso)) {
                    ?>
                        <tr>
                            <td><?php echo $row['insumo'] ?></td>
                            <td><?php echo $row['cantidad'] ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <br>

        <div class="text-center">
            <p class="h4">Datos de los Trabajadores</p>
            <table style="width: 750px;margin-top: 30px;" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Trabajador</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    while ($row = mysqli_fetch_assoc($resTrabajador)) {
                        $total = $total + $row['costo'];
                    ?>
                        <tr>
                            <td><?php echo $row['trabajador'] ?></td>
                            <td><?php echo $row['costo'] ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <br>

        <div class="text-right">
            <strong>Total a Pagar: </strong><?php echo "$" . number_format($total, 2); ?>
        </div>
        <br>
    <?php endwhile; ?>

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
