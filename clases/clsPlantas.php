<?php
class Planta
{
    public int $id;
    public string $nombre;
    public float $precio;
    public int $existencia;
    public string $imagen;

    function __construct($id, $nombre, $precio, $existencia, $imagen)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->existencia = $existencia;
        $this->imagen = $imagen;
    }

    public function Registro($con)
    {
        $query = "INSERT INTO plantas(nombre, precio, existencia, imagen)
            VALUES('$this->nombre', '$this->precio', '$this->existencia', '$this->imagen');";
        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT * FROM plantas;";
        return mysqli_query($con, $query);
    }

    public function Modificar($con)
    {
        if (!$this->imagen) {
            $query = "UPDATE plantas set
                nombre = '$this->nombre', precio = '$this->precio', existencia = '$this->existencia'
                WHERE id = '$this->id';
            ";
        } else {
            $query = "UPDATE plantas set
                nombre = '$this->nombre', precio = '$this->precio', existencia = '$this->existencia',
                imagen = '$this->imagen'
                WHERE id = '$this->id';
            ";
        }

        return mysqli_query($con, $query);
    }

    public function Eliminar($con)
    {
        $query = "DELETE FROM plantas WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function ObtenerPrecio($con)
    {
        $query = "SELECT precio FROM plantas WHERE id = '$this->id';";
        $res =  mysqli_query($con, $query);
        $rowPrecio = mysqli_fetch_assoc($res);
        return $rowPrecio['precio'];
    }

    public function ObtenerExistencia($con)
    {
        $query = "SELECT existencia FROM plantas WHERE id = '$this->id'";
        $res = mysqli_query($con, $query);
        $rowExistencia = mysqli_fetch_assoc($res);
        return $rowExistencia['existencia'];
    }
}
