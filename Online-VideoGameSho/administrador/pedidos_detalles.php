<?php
session_start();
$nombreUser = $_SESSION['nombreUser']; 

if($nombreUser == ''){
    header('Location: index.php');
    exit();
}

include('menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quantico:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>

    <script src="jquery-3.3.1.min.js"></script>
    <style>
        section{
            --greenMarti: #a41242 ;
            --blueMArti: #040457;
            display: flex;  
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: auto;
            width: auto;
            padding-top: 20px;
            padding-bottom: 20px;
            border-radius: 150px;
            font-size: x-large;
        }
        .letra {
            font-family: "Quantico", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        h1{
            padding: 20px;
            border-radius: 20px;
            width: auto;
            text-align: center;
            background-color: var(--greenMarti);
            margin: 5px;
            color: white;
        }
        table{
            height: 75%;
            width: 75%;
            padding: 2px; 
            border: 3px solid var(--greenMarti); 
            background-color: white; 
            font-size: large;
            line-height: 40px;
        }
        img{
            height: 200px;
            width: 600px;
            border: 5px solid var(--blueMArti);
            margin-top: 20px;
        }
        tr{
            border: 3px solid var(--greenMarti);
            text-align: center; 
            padding: 10px;
            
        }
        .info{
            font-size: x-large;
            color: var(--greenMarti);
        }
        td{
            padding: 10px;
            text-align: center;
            border: 3px solid var(--greenMarti); 
            width: 70px;
        }
        .boton{
            width: 250px;
            height: 50px;
            background-color: var(--greenMarti);
            cursor: pointer;
            color: white;
            margin-top: 10px;
            font-size: x-large;
        }
        .total{
            background-color: #b6b6f8;
        }

    </style>
</head>
<body>
<?php
      require "funciones/conecta.php";
      $con = conecta();
      $id_pedido = $_REQUEST['id_pedido'];
      $sql2 = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido' ";
      $res2 = $con->query($sql2);                                                           

      $total = 0;
    
    
?>
    
<section>
    <h1>  Detalles del pedido (  <?php echo $id_pedido;?>  ) -- MartisCorp --  </h1>
    <input class="boton" type="submit" value="Back to List"  onclick="window.location.href='pedidos_lista.php';">

    
    <br><table class="letra">
      <tr>
        <td>Producto</td>
        <td>ID del producto</td>
        <td>Cantidad</td>
        <td>Costo Unitario</td>
        <td>SubTotal</td>
      </tr>
      
      <?php
           while($row2 = $res2-> fetch_array()){

            $id_fila=$row2['id'];
            $id_producto = $row2['id_producto'];
            $cantidad = $row2['cantidad'];
            $precio = $row2['precio'];
            $cantidad = (int) $cantidad;
            $precio = (double) $precio;
            $subT = $precio * $cantidad;

            $total +=  $subT;

            $sql3 = "SELECT nombre FROM productos WHERE id = '$id_producto'";
            $res3 = $con->query($sql3);
            $row3 = $res3-> fetch_array();

            $nombre_producto = $row3['nombre'];

            echo " <tr >
                        <td class=\"tdnombre\"> $nombre_producto</td>
                        <td> $id_producto</td>
                        <td> $cantidad</td>
                        <td > $ $precio</td>
                        <td>  $ $subT </td>
                     </tr>";
            
      }  
      ?> 

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="total">Total del pedido:</td>
            <?php echo "<td class=\"total\">  $ $total</td>" ?>        
        </tr>

    </table>
</section>



</body>
</html>