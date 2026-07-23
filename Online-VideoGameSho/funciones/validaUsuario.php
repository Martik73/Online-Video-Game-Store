<?php
session_start();
require "conecta.php";
$con = conecta();


$correo = $_REQUEST['correo'];
$passNoEncr = $_REQUEST['pass'];


// Capturar la variable

    $sql = "SELECT * FROM clientes WHERE eliminado = 0 AND correo = '$correo' AND  pass = '$passNoEncr' ";
    $res = $con->query($sql);
    $num = $res->num_rows;

    
    if($num == 1){
        $row = $res->fetch_array();
        $id = $row["id"];
        $nombre = $row["nombre"].' '.$row["apellidos"];
        $correo = $row["correo"];

        $_SESSION['idUser']  = $id;
        $_SESSION['nombreUser'] = $nombre;
        $_SESSION['correoUser'] = $correo;
    }

    echo $num; // Retorna el número de registros encontrados 


?>
