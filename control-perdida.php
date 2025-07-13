<?php

require_once 'clases/clsPerdida.php';

$perdida = new Perdida();

$res = $perdida->Consultar($con);
require 'views/control-perdida.view.php';
