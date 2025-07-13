<?php

class Venta
{
    public int $id;
    public int $idcliente;
    public int $idplanta;
    public float $precio;
    public int $cantidad;
    public float $total;
    public string $codigo;

    function __construct($id, $idcliente, $idplanta, $precio, $cantidad, $total, $codigo)
    {
        $this->id = $id;
        $this->idcliente = $idcliente;
        $this->idplanta = $idplanta;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->total = $total;
        $this->codigo = $codigo;
    }

    public function Consultar($con)
    {
        $query = "SELECT codigo, c.nombre as cliente, fecha, sum(v.total) as total,
            idcliente
            FROM ventas v join clientes c on v.idcliente = c.id
            GROUP BY codigo ORDER BY v.fecha DESC";
        return mysqli_query($con, $query);
    }

    public function ConsultarVentaGenerada($con)
    {
        $query = "SELECT v.id, v.codigo, p.nombre as planta, c.nombre as cliente,
        v.cantidad, v.precio, v.total, v.fecha
        FROM ventas v join plantas p on v.idplanta = p.id
        join clientes c on v.idcliente = c.id
        where codigo = '$this->codigo';";
        return mysqli_query($con, $query);
    }

    public function Registro($con)
    {
        $query = "INSERT INTO ventas(idplanta, idcliente, fecha, precio, cantidad, total, codigo)
        VALUES('$this->idplanta', '$this->idcliente', NOW(), '$this->precio', '$this->cantidad', '$this->total', '$this->codigo');";

        return mysqli_query($con, $query);
    }

    public function ObtenerIdCliente($con)
    {
        $query = "SELECT idcliente FROM ventas WHERE codigo = '$this->codigo' LIMIT 1";
        $res = mysqli_query($con, $query);
        $rowProveedor = mysqli_fetch_assoc($res);
        return $rowProveedor['idcliente'] ?? '';
    }
}
