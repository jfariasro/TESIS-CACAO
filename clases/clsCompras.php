<?php

class Compra
{
    public int $id;
    public int $idproveedor;
    public int $idinsumo;
    public DateTime $fecha;
    public float $precio;
    public int $cantidad;
    public float $total;
    public string $codigo;

    function __construct($id, $idproveedor, $idinsumo, $precio, $cantidad, $total, $codigo)
    {
        $this->id = $id;
        $this->idproveedor = $idproveedor;
        $this->idinsumo = $idinsumo;
        $this->fecha = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->total = $total;
        $this->codigo = $codigo;
    }

    public function Consultar($con)
    {
        $query = "SELECT codigo, p.nombre as proveedor, fecha, sum(c.total) as total,
            idproveedor, factura
            FROM compras c join proveedores p on c.idproveedor = p.id
            WHERE factura != '0000-0000'
            GROUP BY codigo ORDER BY c.fecha DESC";
        return mysqli_query($con, $query);
    }

    public function ConsultarCompraGenerada($con)
    {
        $query = "SELECT c.id, c.codigo, i.nombre as insumo, pr.nombre as proveedor,
        c.cantidad, c.precio, c.total, c.fecha
        FROM compras c join insumos i on c.idinsumo = i.id
        join proveedores pr on c.idproveedor = pr.id
        where codigo = '$this->codigo';";
        return mysqli_query($con, $query);
    }

    public function ObtenerDatosDeCompras($con)
    {
        $query = "SELECT c.codigo, pr.nombre as proveedor,
        SUM(c.precio * c.cantidad) AS total
        FROM compras c join proveedores pr on c.idproveedor = pr.id
        where codigo = '$this->codigo';";
        $res = mysqli_query($con, $query);

        return mysqli_fetch_assoc($res);
    }

    public function Registro($con)
    {
        $query = "INSERT INTO compras(idinsumo, idproveedor, fecha, precio, cantidad, total, codigo)
        VALUES('$this->idinsumo', '$this->idproveedor', NOW(), '$this->precio', '$this->cantidad', '$this->total', '$this->codigo');";

        return mysqli_query($con, $query);
    }

    public function ActualizarCantidadInsumo($con) {
        $query = "UPDATE compras SET cantidad = '$this->cantidad',
        total = precio * '$this->cantidad'
        WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function ObtenerIdProveedor($con)
    {
        $query = "SELECT idproveedor FROM compras WHERE codigo = '$this->codigo' LIMIT 1";
        $res = mysqli_query($con, $query);
        $rowProveedor = mysqli_fetch_assoc($res);
        return $rowProveedor['idproveedor'] ?? '';
    }
}
