<?php
session_start();

    if (!isset($_SESSION['nombreUser']) || $_SESSION['nombreUser'] == '') {
        echo "1";
        exit;
    } 

$id_cliente = $_SESSION['idUser']; //Obtenemos el id_cliente atraves de la sesión
require "funciones/conecta.php";
$con = conecta();

$id_producto = $_REQUEST['id']; //Datos mandados por el ajax
$cantidad = $_REQUEST['cantidad'];
$name = $_REQUEST['name'];


$sql = "SELECT * FROM pedidos WHERE id_cliente = '$id_cliente' AND status = 0 "; //Revisar si existen pedidos abiertos 
$res = $con->query($sql);                                                           //Para este cliente 
$num = $res->num_rows;

if($num == 0 ){ //Si no encontró registros con el id del cliente y el status en 0 crear uno
    $sql = "INSERT INTO pedidos (id_cliente) VALUES('$id_cliente')";
    $res = $con->query($sql);
    $id_pedido = $con->insert_id; // Obtener el último ID generado
}
else{
    $row = $res-> fetch_array();
    $id_pedido = $row["id"];
}


    $sql2 = "SELECT costo FROM productos WHERE id = '$id_producto' AND eliminado = 0 "; //Obtener precio del producto
    $res2 = $con->query($sql2);
        $row2 = $res2-> fetch_array();
        $precio = $row2["costo"];
    
        $cantidad = (int) $cantidad; //PAra convertir los arreglos en enteros para poder multiplicarlos
        $precio = (double) $precio;


        $sql3 = "SELECT * FROM pedidos_productos WHERE id_producto = '$id_producto' AND id_pedido = '$id_pedido'";  //Este era el problema 
        $res3 = $con->query($sql3);       //Revisar que ya exista el mismo producto para solo actualizarle la cantidad
        $num3 = $res3->num_rows;

        if($num3 == 1){
            $sql4 = "UPDATE pedidos_productos SET cantidad = cantidad + $cantidad 
            WHERE id_producto = $id_producto AND id_pedido = '$id_pedido'"; //La ultima modificación
            $res4 = $con->query($sql4);
        }
        else{
            $sql5 = "INSERT INTO pedidos_productos ( id_pedido, id_producto, cantidad, precio) 
            VALUES('$id_pedido','$id_producto', $cantidad, $precio)";
            $res5 = $con->query($sql5);
        } 
        
echo $name;

?>