<?php

class GestionActividad
{
    public int $id;
    public int $idactividades;

    public $idgestionactividad;
    public int $idtrabajador;
    public float $costo;

    public int $idinsumo;
    public int $cantidad;

    public function AgregarGestion($con)
    {
        $query = "INSERT INTO gestion_actividad(idactividades, fecha)
        VALUES('$this->idactividades', NOW())";
        return mysqli_query($con, $query);
    }

    public function AgregarGestionRecurso($con)
    {
        $query = "INSERT INTO actividad_recurso(idgestionactividad, idinsumo, cantidad)
        VALUES('$this->idgestionactividad', '$this->idinsumo', '$this->cantidad')";
        return mysqli_query($con, $query);
    }

    public function AgregarGestionTrabajador($con)
    {
        $query = "INSERT INTO actividad_trabajador(idgestionactividad, idtrabajador, costo)
        VALUES('$this->idgestionactividad', '$this->idtrabajador', '$this->costo')";
        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT ga.id, a.nombre AS actividad, ta.nombre AS tipo,
        ga.fecha FROM
        gestion_actividad ga JOIN actividades a ON a.id = ga.idactividades
        JOIN tipoactividades ta ON ta.id = a.idtipoactividades";
        return mysqli_query($con, $query);
    }

    public function ConsultarGestion($con)
    {
        $query = "SELECT ga.id, a.nombre AS actividad, ta.nombre AS tipo,
        ga.fecha FROM
        gestion_actividad ga JOIN actividades a ON a.id = ga.idactividades
        JOIN tipoactividades ta ON ta.id = a.idtipoactividades
        WHERE ga.id = '$this->idgestionactividad'";
        $res = mysqli_query($con, $query);
        return mysqli_fetch_assoc($res);
    }

    public function ConsultarGestionProduccion($con)
    {
        $query = "SELECT ga.id, a.nombre AS actividad, ta.nombre AS tipo,
        ga.fecha, pl.nombre as planta FROM
        gestion_actividad ga JOIN actividades a ON a.id = ga.idactividades
        JOIN tipoactividades ta ON ta.id = a.idtipoactividades
        JOIN actividad_produccion ap ON ap.idgestionactividad = ga.id
        JOIN produccion p ON p.id = ap.idproduccion
        JOIN plantas pl ON pl.id = p.idplanta
        WHERE ga.id = '$this->idgestionactividad'";
        $res = mysqli_query($con, $query);
        return mysqli_fetch_assoc($res);
    }

    public function ConsultarGestionRecurso($con)
    {
        $query = "SELECT ar.id, i.nombre AS insumo, ar.cantidad, ar.idinsumo, ar.idgestionactividad
        FROM gestion_actividad ga JOIN actividad_recurso ar ON ar.idgestionactividad = ga.id
        JOIN insumos i ON i.id = ar.idinsumo
        WHERE ar.idgestionactividad = '$this->idgestionactividad'";
        return mysqli_query($con, $query);
    }

    public function ConsultarGestionTrabajador($con)
    {
        $query = "SELECT atr.id, t.nombre AS trabajador, atr.costo, atr.idtrabajador, atr.idgestionactividad
        FROM gestion_actividad ga JOIN actividad_trabajador atr ON atr.idgestionactividad = ga.id
        JOIN trabajadores t ON t.id = atr.idtrabajador
        WHERE atr.idgestionactividad = '$this->idgestionactividad'";
        return mysqli_query($con, $query);
    }
}
