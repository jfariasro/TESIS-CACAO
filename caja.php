<?php

$query = "SELECT * FROM caja WHERE estado = true";
$res = mysqli_query($con, $query);

require 'views/caja.view.php';