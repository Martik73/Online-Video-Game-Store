<?php
require "conecta.php";
$con = conecta();


$codigo = $_REQUEST['codigo'];

// Capturar la variable

    $sql = "SELECT * FROM productos WHERE eliminado = 0 AND codigo = '$codigo'";
    $res = $con->query($sql);
    $num = $res->num_rows;

    echo $num; // Retorna el número de registros encontrados


?>
