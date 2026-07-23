<?php
require "conecta.php";
$con = conecta();


$correo = $_REQUEST['correo'];

// Capturar la variable

    $sql = "SELECT * FROM empleados WHERE eliminado = 0 AND correo = '$correo'";
    $res = $con->query($sql);
    $num = $res->num_rows;

    echo $num; // Retorna el número de registros encontrados
    echo $correo; 


?>
