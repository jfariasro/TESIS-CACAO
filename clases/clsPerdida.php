<?php

class Perdida
{
    public int $idproduccion;
    public int $cantidad;
    public string $descripcion;

    public function Agregar($con)
    {
        $query = "INSERT INTO perdida(id, idproduccion, cantidad, descripcion, fecha)
        VALUES(null,'$this->idproduccion', '$this->cantidad', '$this->descripcion', NOW());";
        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT id, fecha, cantidad, descripcion FROM perdida;";
        return mysqli_query($con, $query);
    }
}
