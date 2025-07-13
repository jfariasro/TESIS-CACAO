<?php
require_once 'clases/clsGestionActividad.php';

$gestion = new GestionActividad();

$res = $gestion->Consultar($con);

require 'views/control-actividades.view.php';