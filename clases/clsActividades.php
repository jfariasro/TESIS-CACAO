<?php
class Actividad
{
    public int $id;
    public string $nombre;
    public string $idtipoactividades;
    public string $descripcion;

    function __construct($id, $nombre, $idtipoactividades, $descripcion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idtipoactividades = $idtipoactividades;
        $this->descripcion = $descripcion;
    }

    public function Registro($con)
    {
        $query = "INSERT INTO actividades(nombre, idtipoactividades, descripcion)
        VALUES('$this->nombre', '$this->idtipoactividades', '$this->descripcion');";

        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT a.id, a.nombre, a.idtipoactividades, ta.nombre AS tipoactividad,
        a.descripcion FROM actividades a
        JOIN tipoactividades ta ON a.idtipoactividades = ta.id;";
        return mysqli_query($con, $query);
    }

    public function ConsultarSinProduccion($con)
    {
        $query = "SELECT a.id, a.nombre, a.idtipoactividades, ta.nombre AS tipoactividad,
        a.descripcion FROM actividades a
        JOIN tipoactividades ta ON a.idtipoactividades = ta.id
        WHERE ta.nombre != 'Actividad de Producción';";
        return mysqli_query($con, $query);
    }

    public function ConsultarConProduccion($con)
    {
        $query = "SELECT a.id, a.nombre, a.idtipoactividades, ta.nombre AS tipoactividad,
        a.descripcion FROM actividades a
        JOIN tipoactividades ta ON a.idtipoactividades = ta.id
        WHERE ta.nombre = 'Actividad de Producción';";
        return mysqli_query($con, $query);
    }

    public function Buscar($con){
        $query = "SELECT * FROM actividades WHERE id = $this->id;";
        $res = mysqli_query($con, $query);
        return mysqli_fetch_assoc($res);
    }

    public function Modificar($con)
    {
        $query = "UPDATE actividades
        SET nombre = '$this->nombre', idtipoactividades = '$this->idtipoactividades',
        descripcion = '$this->descripcion' WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function Eliminar($con)
    {
        $query = "DELETE FROM actividades WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }
}
