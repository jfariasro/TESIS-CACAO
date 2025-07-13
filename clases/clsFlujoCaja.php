<?php
class FlujoCaja
{
    public int $id;
    public int $idcaja;
    public int $idmovimiento;
    public $fecha;
    public float $entrada;
    public float $salida;
    public float $parcial;

    public function Agregar($con)
    {
        $query = "INSERT INTO flujocaja(idcaja, idmovimientos, fecha, entrada, salida, parcial)
        VALUES('$this->idcaja', '$this->idmovimiento', '$this->fecha', '$this->entrada', '$this->salida', '$this->parcial')";
        return mysqli_query($con, $query);
    }

    public function AbrirCaja($con)
    {
        date_default_timezone_set('America/Guayaquil');
        $fechaActual = new DateTime();
        $fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
        $parcial = $this->ConsultarTotal($con);
        $query = "INSERT INTO caja(fecha_inicio, total) VALUES('$fechaFormateada', '$parcial');";
        $res = mysqli_query($con, $query);

        return mysqli_insert_id($con);
    }

    public function AbrirFlujoCaja($con, $idcaja, $idmovimientos)
    {
        date_default_timezone_set('America/Guayaquil');
        $fechaActual = new DateTime();
        $fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
        $parcial = $this->ConsultarTotal($con);
        $query = "INSERT INTO flujocaja(idcaja, idmovimientos, fecha, parcial)
        VALUES('$idcaja', '$idmovimientos', '$fechaFormateada', '$parcial');";
        mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT fc.id, fc.idcaja, m.nombre AS movimiento,
        fc.fecha, fc.entrada, fc.salida, fc.parcial FROM
        flujocaja fc JOIN caja c ON c.id = fc.idcaja
        JOIN movimientos m ON m.id = fc.idmovimientos
        WHERE c.estado = false
        ORDER BY fc.fecha DESC";
        return mysqli_query($con, $query);
    }

    public function ConsultarIdEstado($con)
    {
        $query = "SELECT id FROM caja WHERE estado = false LIMIT 1";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        return $row['id'] ?? '';
    }

    public function ConsultarTotal($con)
    {
        $query = "SELECT total FROM caja ORDER BY id DESC LIMIT 1";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        return $row['total'] ?? 0;
    }

    public function ModificarCaja($con, $valor, $idcaja)
    {
        $query = "UPDATE caja SET total = '$valor' WHERE id = '$idcaja'";
        $res = mysqli_query($con, $query);
    }

    public function CerrarCaja($con)
    {
        date_default_timezone_set('America/Guayaquil');
        $fechaActual = new DateTime();
        $fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
        $query = "UPDATE caja SET estado = true, fecha_fin = '$fechaFormateada'
        WHERE id = '$this->idcaja';";
        $res = mysqli_query($con, $query);
    }

    public function ContarFlujoCaja($con, $idcaja)
    {
        $query = "SELECT count(*) AS contar FROM flujocaja WHERE idcaja = '$idcaja';";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        return $row['contar'];
    }
}
