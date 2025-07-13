<?php

require_once 'clases/clsGestionActividad.php';
require_once 'clases/clsActividades.php';
require_once 'clases/clsInsumos.php';
require_once 'clases/clsProduccion.php';
require_once 'clases/clsPlantas.php';

$gestion = new GestionActividad();
$produccion = new Produccion();

if (isset($_REQUEST['codigoProduccion']) && $_REQUEST['codigoProduccion'] !== '') {
    $_SESSION['codigoProduccion'] = $_REQUEST['codigoProduccion'];
    echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
}

function AgregarProduccion($con, $idplanta, $cantidad)
{
    $produccion = new Produccion();
    $produccion->idplanta = $idplanta;
    $produccion->cantidad = $cantidad;

    $res = $produccion->AgregarActividadProduccion($con);
    $_SESSION['codigoProduccion'] = mysqli_insert_id($con);
}

if (isset($_POST['agregar_insumo'])) {
    if ($_SESSION['codigoProduccion'] == '') {
        AgregarProduccion($con, $_POST['idplanta'], $_POST['cantidad_planta']);
    }
    $idinsumo = $_POST['idinsumo'];

    if ($_SESSION['codigoActividadProduccion'] == '') {
        $idactividad = $_POST['idactividad'];
    }

    $cantidad = $_POST['cantidad'];

    $mensaje = '';

    if ($cantidad <= 0) {
        $mensaje .= '<b>La cantidad debe ser mayor a 0</b><br>';
    }

    $insumos = new Insumo($idinsumo, '', 0, 0, '');
    $existencia = $insumos->ObtenerExistencia($con);

    if ($existencia < $cantidad) {
        $mensaje .= '<b>La cantidad no debe ser mayor a la existencia</b>';
    }
    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $gestion->idinsumo = $idinsumo;
        $gestion->cantidad = $cantidad;
        if ($_SESSION['codigoActividadProduccion'] == '') {
            $gestion->idactividades = $idactividad;
            $res = $gestion->AgregarGestion($con);
            if ($res) {
                $_SESSION['codigoActividadProduccion'] = mysqli_insert_id($con);
                $codigo = $_SESSION['codigoActividadProduccion'];
                $query = "INSERT INTO actividad_produccion(idgestionactividad, idproduccion)
                VALUES('$codigo', '" . $_SESSION['codigoProduccion'] . "');";
                $res = mysqli_query($con, $query);
            }
        }

        $gestion->idgestionactividad = $_SESSION['codigoActividadProduccion'];

        if ($_SESSION['codigoActividadProduccion'] !== '') {
            $res = $gestion->AgregarGestionRecurso($con);
            if ($res) {
                $_SESSION['mensaje'] = '<b>Actividad generada exitosamente</b>';
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
            } else {
                $_SESSION['error'] = '<b>Actividad no pudo ser generada</b>';
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
            }
        } else {
            $_SESSION['error'] = '<b>Actividad no Registrada</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
        }
    }
} else if (isset($_POST['agregar_trabajador'])) {
    if ($_SESSION['codigoProduccion'] == '') {
        AgregarProduccion($con, $_POST['idplanta'], $_POST['cantidad_planta']);
    }
    $idtrabajador = $_POST['idtrabajador'];

    if ($_SESSION['codigoActividadProduccion'] == '') {
        $idactividad = $_POST['idactividad'];
    }

    $costo = $_POST['costo'];

    $mensaje = '';

    if ($costo <= 0) {
        $mensaje .= '<b>El costo debe ser mayor a 0</b><br>';
    }

    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $gestion->idtrabajador = $idtrabajador;
        $gestion->costo = $costo;
        if ($_SESSION['codigoActividadProduccion'] == '') {
            $gestion->idactividades = $idactividad;
            $res = $gestion->AgregarGestion($con);
            if ($res) {
                $_SESSION['codigoActividadProduccion'] = mysqli_insert_id($con);
                $codigo = $_SESSION['codigoActividadProduccion'];
                $query = "INSERT INTO actividad_produccion(idgestionactividad, idproduccion)
                VALUES('$codigo', '" . $_SESSION['codigoProduccion'] . "');";
                $res = mysqli_query($con, $query);
            }
        }

        $gestion->idgestionactividad = $_SESSION['codigoActividadProduccion'];

        if ($_SESSION['codigoActividadProduccion'] !== '') {
            $res = $gestion->AgregarGestionTrabajador($con);
            if ($res) {
                $_SESSION['mensaje'] = '<b>Actividad generada exitosamente</b>';
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
            } else {
                $_SESSION['error'] = '<b>Actividad no pudo ser generada</b>';
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
            }
        } else {
            $_SESSION['error'] = '<b>Actividad no Registrada</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
        }
    }
} else if (isset($_POST['modificar_cantidad'])) {
    $cantidad = $_POST['edit_cantidad'];
    $idinsumo = $_POST['id1'];
    $id = $_POST['edit_id1'];

    $mensaje = '';

    if ($cantidad <= 0) {
        $mensaje .= '<b>La cantidad debe ser mayor a 0</b><br>';
    }

    $insumos = new Insumo($idinsumo, '', 0, 0, '');
    $existencia = $insumos->ObtenerExistencia($con);

    if ($existencia < $cantidad) {
        $mensaje .= '<b>La cantidad no debe ser mayor a la existencia</b>';
    }
    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $query = "UPDATE actividad_recurso SET cantidad = '$cantidad'
        WHERE id = '$id'";
        $res = mysqli_query($con, $query);

        if ($res) {
            $_SESSION['mensaje'] = '<b>Actividad modificada exitosamente</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
        } else {
            $_SESSION['error'] = '<b>Actividad no pudo ser modificada</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
        }
    }
} else if (isset($_POST['modificar_costo'])) {
    $costo = $_POST['edit_costo'];
    $idtrabajador = $_POST['id2'];
    $id = $_POST['edit_id2'];

    $mensaje = '';

    if ($costo <= 0) {
        $mensaje .= '<b>La cantidad debe ser mayor a 0</b><br>';
    }

    if (strlen($mensaje) > 0) {
        AlertaAdvertencia($mensaje);
    } else {
        $query = "UPDATE actividad_trabajador SET costo = '$costo'
        WHERE id = '$id'";
        $res = mysqli_query($con, $query);

        if ($res) {
            $_SESSION['mensaje'] = '<b>Actividad modificada exitosamente</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
        } else {
            $_SESSION['error'] = '<b>Actividad no pudo ser modificada</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
        }
    }
} else if (isset($_POST['delete_recurso'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_id1'] ?? '');
    $query = "DELETE from actividad_recurso where id='$id';";
    $res = mysqli_query($con, $query);
    if ($res) {
        $codigo = mysqli_real_escape_string($con, $_POST['delete_codigo'] ?? '');
        $query = "SELECT count(*) as total from actividad_recurso where idgestionactividad = '$codigo';";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);

        $query = "SELECT count(*) as total from actividad_trabajador where idgestionactividad = '$codigo';";
        $res = mysqli_query($con, $query);
        $row2 = mysqli_fetch_assoc($res);

        if ($row['total'] == 0 && $row2['total'] == 0) {
            $query = "DELETE from gestion_actividad where id='$codigo';";
            $res = mysqli_query($con, $query);
            $_SESSION['mensaje'] = '<b>Actividades Eliminadas</b>';
            $_SESSION['codigoActividadProduccion'] = '';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
        } else {
            AlertaExitosa('<b>Actividad Borrada Exitosamente</b>');
        }
    } else {
        AlertaError('<b>Error al borrar la Actividad</b>');
    }
} else if (isset($_POST['delete_trabajador'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_id2'] ?? '');
    $query = "DELETE from actividad_trabajador where id='$id';";
    $res = mysqli_query($con, $query);
    if ($res) {
        $codigo = mysqli_real_escape_string($con, $_POST['delete_codigo2'] ?? '');
        $query = "SELECT count(*) as total from actividad_recurso where idgestionactividad = '$codigo';";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);

        $query = "SELECT count(*) as total from actividad_trabajador where idgestionactividad = '$codigo';";
        $res = mysqli_query($con, $query);
        $row2 = mysqli_fetch_assoc($res);

        if ($row['total'] == 0 && $row2['total'] == 0) {
            $query = "DELETE from gestion_actividad where id='$codigo';";
            $res = mysqli_query($con, $query);
            $_SESSION['mensaje'] = '<b>Actividades Eliminadas</b>';
            $_SESSION['codigoActividadProduccion'] = '';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-produccion" />  ';
        } else {
            AlertaExitosa('<b>Actividad Borrada Exitosamente</b>');
        }
    } else {
        AlertaError('<b>Error al borrar la Actividad</b>');
    }
}

// $_SESSION['codigoProduccion'] = '';

$codigo = $_SESSION['codigoActividadProduccion'] ?? '';
$gestion->idgestionactividad = $codigo;
$resRecurso = $gestion->ConsultarGestionRecurso($con);
$resTrabajadorAc = $gestion->ConsultarGestionTrabajador($con);

$actividades = new Actividad(-1, '', '', '');
$resActividad1 = $actividades->ConsultarConProduccion($con);
$resActividad2 = $actividades->ConsultarConProduccion($con);

$consulta = "SELECT i.id, i.nombre FROM insumos i
WHERE i.id NOT IN (
  SELECT ar.idinsumo
  FROM actividad_recurso ar
  WHERE ar.idgestionactividad = '$codigo'
)";
$resInsumo = mysqli_query($con, $consulta);

$consulta = "SELECT t.id, t.nombre FROM trabajadores t
WHERE t.id NOT IN (
  SELECT atr.idtrabajador
  FROM actividad_trabajador atr
  WHERE atr.idgestionactividad = '$codigo'
)";
$resTrabajador = mysqli_query($con, $consulta);

$gestion_actividad = $gestion->ConsultarGestionProduccion($con);

$consulta = "SELECT id, nombre FROM plantas;";
$resPlanta1 = mysqli_query($con, $consulta);
$resPlanta2 = mysqli_query($con, $consulta);

$idproduccion = $_SESSION['codigoProduccion'] ?? '';
if ($idproduccion !== '') {
    $query = "SELECT f.nombre
    FROM produccion P JOIN fases f
    ON f.id = p.idfase
    WHERE p.id = '$idproduccion'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    $fasenombre = $row['nombre'];
}

require 'views/generar-produccion.view.php';
