<?php
  session_start();
  if (isset($_SESSION['nombreUser']) && $_SESSION['nombreUser'] != '') {
      $id_cliente = $_SESSION['idUser'];
      $nombreUser = $_SESSION['nombreUser'];
      include("menu.php");
  } else {
      header("Location:index.php");
  }
?>
<html>
   <head>
      <title>
      Carrito 
      </title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


      <style>
        section{
            --purpleMarti: #1c0332;
            --tintoMarti: #581845; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
         }
         
         h1{
            color: white;
            background-color: var(--purpleMarti);
            padding: 10px;
            border-radius: 10px;
            font-size: x-large;
            font-family: "Metal Mania", system-ui;
            font-weight: 400;
            font-style: normal;
            margin: 10px;
            margin-top: 2px;
            border: solid 5px var(--tintoMarti);
         }
         table{
            border: solid 10px var(--tintoMarti);
            width: 60vw;
            height: 45vh;
         }
         tr{
            border: solid 3px var(--tintoMarti);
         }
         td{
            border: solid 3px var(--tintoMarti);
            width: 70px;
         }
         .encabezado{
            font-style: normal;
            font-family: "Metal Mania", system-ui;
            font-weight: 400;
            background-color: var(--purpleMarti);
            color: white;
         }
         td.tdnombre{
            width: 120px;
         }
         .total{
            background-color: #c9bdd1;
            font-size: medium;
         }
         .boto{
            align-items: center;
            text-align: center;
            padding: 5px;
            margin-top: 10px ;
         }
         .still{
            background-color:  #1c0332;
            color: white;
            padding: 10px;
            font-size: large;
            cursor: pointer;
            margin-right: 10px;
            border-radius: 20px;
            width: 150px;
         }
         .next{
            background-color: green;
            color: white;
            padding: 10px;
            font-size: large;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 20px;
            width: 200px;
         }
         .topright{
            display: grid;
            position: relative;
            margin-bottom: -50px;
         }
         
         #exito{
            position: fixed;
            top: 45%; 
            left: 30%; 
            z-index: 1000;
            background-color: green;
            padding: 20px;
            text-align: center;
            border-radius: 20px ;
            display: none;
            color: white;
            font-size: xx-large;
            border: solid 5px var(--purpleMarti); 
         }
         .end{
            border: 4px solid #1c0332;
            border-radius: 20px;
            width: 95%;
            height: 20%;
            justify-content: left;
            margin-top: 40px;
            padding: 10px;
            font-family: "Metal Mania", system-ui;
            font-weight: 400;
            font-style: normal;
            font-size: large;
            text-align: center;
         }
         a{
            margin: 20px;
         }
         html{
         background-color: #e2d9e7;
         }
      </style>

      <script src="jquery-3.3.1.min.js"></script>
      <script>
        
       function finalizar(id_cliente){
         var pedido = $('.id_pedido').data('pedido');

         if(confirm("¿Desea finalizar el pedido?")){
               $.ajax({
                  url     : 'carroFinal.php',
                  type    : 'post',
                  dataType: 'text',
                  data    : { id_cliente: id_cliente, pedido: pedido},

                  success: function(res){
                     console.log(res);
                        if(res == 1){
                           $("#exito").html('¡El pedido ha sido enviado! Número de pedido: ( 2457854 )').fadeIn();
                           setTimeout(() => { $("#exito").fadeOut(); 
                           window.location.href = "index.php"; 
                           }, 5000);
                        }
                  }
               })
         }
         else{
            return;
         }
       }

      </script>

   </head>

   <body>

   <?php
      require "funciones/conecta.php";
      $con = conecta();
      $sql = "SELECT id FROM pedidos WHERE id_cliente = '$id_cliente' AND status = 0 "; 
      $res = $con->query($sql);                                                           
      $row = $res-> fetch_array();
      $id_pedido = $row["id"];
      $total = 0;
   ?>

   <section>
      <h1 class="id_pedido"  data-pedido="<?php echo $id_pedido ?>"> Carrito de compras -----  Paso: ( 1 / 2 ) ----- Pedido N. (  <?php echo "$id_pedido"?>  ) </h1>
      <h1>Cliente: --  <?php  echo $nombreUser?>  --</h1>

      <table>
      <tr class="encabezado">
            <td>Producto</td>
            <td>Cantidad</td>
            <td>Costo Unitario</td>
            <td>SubTotal</td>
      </tr>
      <?php
            
            $sql2 = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido' ";
            $res2 = $con->query($sql2);                                                           

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
                     <?php echo "<td class=\"total\">  $ $total</td>" ?>
                     
                  </tr>
      </table>
      <div id="exito"></div>
   </section>
   <div class="boto">
      <input class="still" type="submit"  value="Regresar" onclick="window.location.href='carritoPrimis.php';">
      <?php 
         echo "<input class=\"next\" type=\"submit\"  value=\"Finalizar\"  onclick=\"finalizar($id_cliente);\" >"
      ?>
   </div>
   <div class="end"> 
      -- <a href="derechos.html">Todos los derechos reservados 2024</a> --
      -- <a href="terminos.html">Terminos y condiciones</a> --
      -- <a href="politicas.html">Politicas de privacidad</a> --
      -- <a href="redes.html">Redes sociales</a> --
   </div>
   
</body>
</html>

 