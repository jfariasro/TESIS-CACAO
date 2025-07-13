<?php
class Movimiento
{
    public int $id;
    public string $nombre;
    public string $descripcion;
    public int $idtipo;

    function __construct($id, $nombre, $descripcion, $idtipo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->idtipo = $idtipo;
    }

    public function Registro($con)
    {
        $query = "INSERT INTO movimientos(nombre, descripcion, idtipo)
        VALUES('$this->nombre', '$this->descripcion', '$this->idtipo');";

        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT m.id, m.nombre AS movimiento, m.descripcion, tm.nombre AS tipo, m.idtipo
        FROM movimientos m JOIN tipomovimiento tm ON m.idtipo = tm.id;";
        return mysqli_query($con, $query);
    }

    public function ConsultarMovimientoTipo1($con)
    {
        $query = "SELECT m.id, m.nombre AS movimiento, m.descripcion, tm.nombre AS tipo, m.idtipo
        FROM movimientos m JOIN tipomovimiento tm ON m.idtipo = tm.id WHERE m.idtipo = 1 AND m.nombre != 'Apertura'
        AND m.nombre != 'Venta'";
        return mysqli_query($con, $query);
    }

    public function ConsultarMovimientoTipo2($con)
    {
        $query = "SELECT m.id, m.nombre AS movimiento, m.descripcion, tm.nombre AS tipo, m.idtipo
        FROM movimientos m JOIN tipomovimiento tm ON m.idtipo = tm.id WHERE m.idtipo = 2 AND m.nombre != 'Compra' AND m.nombre != 'Actividad o Producción'";
        return mysqli_query($con, $query);
    }

    public function Buscar($con){
        $query = "SELECT * FROM movimientos WHERE id = $this->id;";
        $res = mysqli_query($con, $query);
        return mysqli_fetch_assoc($res);
    }

    public function Modificar($con)
    {
        $query = "UPDATE movimientos
        SET nombre = '$this->nombre', descripcion = '$this->descripcion', idtipo = '$this->idtipo' WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function ConsultarTipo($con){
        $query = "SELECT * FROM tipomovimiento";    
        return mysqli_query($con, $query);
    }

    public function Eliminar($con)
    {
        $query = "DELETE FROM movimientos WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function ObtenerMovimientoEspecifico($con, $movimiento){
        $query = "SELECT id FROM movimientos WHERE nombre = '$movimiento'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        mysqli_free_result($res);

        return $row['id'];
    }
}
