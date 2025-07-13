<?php

class Validaciones
{
    public static function ValidarCedula($cedula)
    {
        $mensaje = "";

        if (strlen($cedula) == 10) {
            if (intval(substr($cedula, 0, 2)) < 1 || intval(substr($cedula, 0, 2)) > 24) {
                $mensaje .= "<b>Los 2 Primeros Dígitos Son Inválidos</b>";
            } else {
                $digito = 0;
                $suma = 0;

                for ($i = 0; $i < strlen($cedula); $i++) {
                    $digito = intval(substr($cedula, $i, 1));

                    if (($i + 1) % 2 !== 0) {
                        $digito *= 2;
                        if ($digito > 9) {
                            $digito -= 9;
                        }
                    }

                    $suma += $digito;
                }

                if ($suma % 10 !== 0) {
                    $mensaje .= "<b>Número de Cédula Inválido</b>";
                }
            }
        } else {
            $mensaje .= "<b>La Cédula debe tener 10 Dígitos</b>";
        }

        return $mensaje;
    }
}
