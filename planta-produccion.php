<?php

require_once 'clases/clsProduccion.php';
require_once 'clases/clsPerdida.php';

$produccion = new Produccion();

if (isset($_POST['agregar_mortalidad'])) {
    $perdida = new Perdida();
    $produccion->idproduccion = $_POST['id'];
    $produccion->cantidad = $_POST['existencia'];
    $mortalidad = $_POST['mortalidad'];
    $descripcion = $_POST['descripcion'];

    if ($mortalidad > $produccion->cantidad) {
        AlertaAdvertencia('<b>La cantidad de mortalidad no debe ser mayor a la existencia actual</b>');
    } else {
        $res = $produccion->AgregarMortalidad($con, $mortalidad);
        if ($res) {
            $perdida->idproduccion = $produccion->idproduccion;
            $perdida->cantidad = $mortalidad;
            $perdida->descripcion = $descripcion;

            $resultado = $perdida->Agregar($con);

            if ($mortalidad == $produccion->cantidad) {
                $res = $produccion->FinalizarProduccion($con);
                $_SESSION['mensaje'] = "<b>Producción Finalizada</b>";
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=planta-produccion" />  ';
            } else {
                $_SESSION['mensaje'] = "<b>Mortalidad Agregada a Producción</b>";
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=planta-produccion" />  ';
            }
        } else {
            AlertaError('<b>La mortalidad no fue agregada</b>');
        }
    }
}

$res = $produccion->Inventario($con);

require 'views/planta-produccion.view.php';
