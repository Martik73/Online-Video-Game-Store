<?php
require "conecta.php";
$con = conecta();


$correo = $_REQUEST['correo'];
$id = $_REQUEST['id'];


// Capturar la variable

    $sql = "SELECT * FROM empleados WHERE eliminado = 0 AND correo = '$correo' AND  id != $id";
    $res = $con->query($sql);
    $num = $res->num_rows;

    echo $num; // Retorna el número de registros encontrados
    echo $correo; 


?>
