<?php
class TipoActividad
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
        $query = "INSERT INTO tipoactividades(nombre, descripcion)
        VALUES('$this->nombre', '$this->descripcion');";

        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT * FROM tipoactividades;";
        return mysqli_query($con, $query);
    }

    public function ConsultarSinProduccion($con){
        $query = "SELECT id, nombre FROM tipoactividades WHERE nombre != 'Actividad de Producción'";
        return mysqli_query($con, $query);
    }

    public function Buscar($con){
        $query = "SELECT * FROM tipoactividades WHERE id = $this->id;";
        $res = mysqli_query($con, $query);
        return mysqli_fetch_assoc($res);
    }

    public function Modificar($con)
    {
        $query = "UPDATE tipoactividades
        SET nombre = '$this->nombre', descripcion = '$this->descripcion' WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function Eliminar($con)
    {
        $query = "DELETE FROM tipoactividades WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }
}
