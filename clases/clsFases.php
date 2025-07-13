<?php
class Fase
{
    public int $id;
    public string $nombre;
    public string $descripcion;

    function __construct($id, $nombre, $descripcion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function Registro($con)
    {
        $query = "INSERT INTO fases(nombre, descripcion)
        VALUES('$this->nombre', '$this->descripcion');";

        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT * FROM fases;";
        return mysqli_query($con, $query);
    }

    public function Buscar($con){
        $query = "SELECT * FROM fases WHERE id = $this->id;";
        $res = mysqli_query($con, $query);
        return mysqli_fetch_assoc($res);
    }

    public function Modificar($con)
    {
        $query = "UPDATE fases
        SET nombre = '$this->nombre', descripcion = '$this->descripcion' WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function Eliminar($con)
    {
        $query = "DELETE FROM fases WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function ContarFases($con){
        $query = 'SELECT count(*) as total FROM fases';
        $resultado = mysqli_query($con, $query);
        return mysqli_fetch_assoc($resultado);
    }
}
