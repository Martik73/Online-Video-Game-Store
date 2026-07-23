<?php
  session_start();
  if (isset($_SESSION['nombreUser']) && $_SESSION['nombreUser'] != '') {
      $id_cliente = $_SESSION['idUser'];
      $nombreUser = $_SESSION['nombreUser'];
      include("menu.php");
  } else {
      header("Location:index.php");
  }

  require "funciones/conecta.php";
  $con = conecta();
  $sql = "SELECT id FROM pedidos WHERE id_cliente = '$id_cliente' AND status = 0 "; 
  $res = $con->query($sql); 
                                                          
  

  $row = $res-> fetch_array();
  $id_pedido = $row["id"];
  $total = 0;

?>
<html>
   <head>
      <title>
      Carrito 
      </title>


      <style>
          html{
             background-color: #e2d9e7;
         }
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
         .nover{
            border: none;
            text-align: center;
            width: 45px;
            height: 20px;
            background-color: #e2d9e7;
         }
         .cantidadchanger{
            border: solid 2px var(--purpleMarti);
            border-radius: 10px;
            text-align: center;
            width: 50px;
         }
         td.tdnombre{
            width: 120px;
         }
         .botonDelate{ 
            padding: auto; 
            margin: auto;
            background-color: red;
            cursor: pointer;
            color: white;
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
            width: 170px;
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
         
      </style>

      <script src="jquery-3.3.1.min.js"></script>
      <script>
        
        function eliminaFila(id_fila){
            if(confirm("¿Deseas eliminar este producto del carrito?")){
               var total = $('#total').val();
               var subt = $('.fila_' + id_fila).data('subt');

               $.ajax({
                    url     : 'productosCarro_elimina.php',
                    type    : 'post',
                    dataType: 'text',
                    data    : { id_fila: id_fila, total: total, subt: subt},

                    success: function(res){
                     console.log(res);
                           if(res){
                              $('.fila_'+id_fila).hide();
                              $('#total').val(res);
                           }
                    }
                })

            }
            else{
               return;
            }
        
         }

         function actualizaCantidad(id_fila){
            
            var newcantidad = "";
            var total = "";
            var precio =  "";                //borramos datos anteriores
            var cantidadexistente = "";

            var newcantidad = $('#cantidad_'+ id_fila).val();
            var total = $('#total').val();
            var precio =            $('.fila_' + id_fila).data('precio');
            var cantidadexistente = $('.fila_' + id_fila).data('cantidadexistente');

            if(newcantidad == 0){
               eliminaFila(id_fila);
            }
            
               $.ajax({ 
                    url     : 'productosCarro_EditaCantidad.php',
                    type    : 'post',
                    dataType: 'text',
                    data    : {id_fila: id_fila, precio: precio, newcantidad: newcantidad},

                    success: function(res){
                     console.log(res);
                           if(res){
                              $('#subTotal_'+ id_fila).val(res);
                              $.ajax({ 
                                 url     : 'productosCarro_EditaTotal.php',
                                 type    : 'post',
                                 dataType: 'text',
                                 data    : { precio: precio, newcantidad: newcantidad, total: total, cantidadexistente: cantidadexistente},

                                 success: function(res){
                                 console.log(res);
                                    if(res){
                                       $('#total').val(res);
                                       $('.fila_' + id_fila).attr('data-cantidadexistente', newcantidad);
                                       // Refresca el caché de jQuery para 'data-cantidadexistente'
                                       $('.fila_' + id_fila).data('cantidadexistente', newcantidad);
                                    }
                                 }
                              })
                           }
                    }
                })
                
         }
        
      </script>

   </head>

   <body>

   <section>
      <h1> Carrito de compras -----  Paso: ( 1 / 2 ) ----- Pedido N. (  <?php echo "$id_pedido"?>  ) </h1>
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
                  

                  echo " <tr class=\"fila_$id_fila\" data-subt= \"$subT\" data-precio=\"$precio\" data-cantidadexistente=\"$cantidad\">
                        <td class=\"tdnombre\"> $nombre_producto</td>
                        <td> <input class=\"cantidadchanger\" id=\"cantidad_$id_fila\" type=\"number\" value=\"$cantidad\" onchange=\"actualizaCantidad('$id_fila')\"></td>
                        <td > $ $precio</td>
                        <td>  $ <input class=\"nover\" type=\"text\" id=\"subTotal_$id_fila\" value=\"$subT\" readonly>
                        <td> <input class=\"botonDelate\" type=\"submit\" id=\"elimina\" value=\"Delete\" 
                        onclick=\"eliminaFila('$id_fila')\" </td>
                     </tr>";
            }
      ?>
                  <tr >
                     <td></td>
                     <td></td>
                     <td></td>
                     <?php echo "<td class=\"total\">  $ <input class=\"nover total\" type=\"text\" id=\"total\" value=\"$total\" readonly bg=\"red\"></td>" ?>
                  </tr>
      </table>
   </section>
   <div class="boto">
      <input  class="still" type="submit" value="Seguir comprando" onclick="window.location.href='productos.php';">
      <input class="next" type="submit"  value="Continuar" onclick="window.location.href='carritoSegunds.php';">
   </div>
   <div class="end"> 
      -- <a href="derechos.html">Todos los derechos reservados 2024</a> --
      -- <a href="terminos.html">Terminos y condiciones</a> --
      -- <a href="politicas.html">Politicas de privacidad</a> --
      -- <a href="redes.html">Redes sociales</a> --
   </div>
  
</body>
</html>

 