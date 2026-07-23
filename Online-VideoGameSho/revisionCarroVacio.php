<?php

require "funciones/conecta.php";
$con = conecta();

    $id_cliente = $_REQUEST['idUser'];

    $sql = "SELECT * FROM pedidos WHERE id_cliente = '$id_cliente' AND status = 0 "; 
    $res = $con->query($sql); 
    $num = $res->num_rows; 

    if($num == 1){
        echo 2;
    }
    else{
        echo 1;
    }
?>