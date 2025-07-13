<?php

class Produccion
{
    public int $idproduccion;
    public int $cantidad;
    public int $idplanta;

    public function Inventario($con)
    {
        $query = "SELECT p.cantidad, f.nombre as fase, p.id, p.idfase
        from produccion p join fases f on p.idfase = f.id
        WHERE p.estado = false";

        return mysqli_query($con, $query);
    }

    public function ConsultarProduccion($con){
        $query = "SELECT p.cantidad, f.nombre as fase, p.id,
        p.estado, pl.nombre as planta, p.idfase, p.id, p.fecha_inicio
        from produccion p join fases f on p.idfase = f.id
        JOIN plantas pl ON pl.id = p.idplanta";

        return mysqli_query($con, $query);
    }

    public function AgregarActividadProduccion($con)  {
        $query = "INSERT produccion(fecha_inicio, cantidad, idplanta, idfase)
        VALUES(NOW(), '$this->cantidad', '$this->idplanta', '1')";
        return mysqli_query($con, $query);
    }

    public function AgregarMortalidad($con, $mortalidad){
        $query = "UPDATE produccion SET cantidad = cantidad - '$mortalidad'
        WHERE id = '$this->idproduccion';";
        return mysqli_query($con, $query);
    }

    public function FinalizarProduccion($con){
        $query = "UPDATE produccion SET estado = true, fecha_fin = NOW() WHERE id = '$this->idproduccion'";
        return mysqli_query($con, $query);
    }

    public function ModificarPlantaCantidad($con){
        $query = "SELECT idplanta, cantidad FROM produccion WHERE id = '$this->idproduccion'";
        $res = mysqli_query($con, $query);
        $rowPlanta = mysqli_fetch_assoc($res);

        $idplanta = $rowPlanta['idplanta'];
        $cantidad = $rowPlanta['cantidad'];

        $modificar = "UPDATE plantas SET existencia = existencia + '$cantidad' WHERE id = '$idplanta'";
        return mysqli_query($con, $modificar);
    }
}
