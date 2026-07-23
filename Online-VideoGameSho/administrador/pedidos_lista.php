<?php
session_start();
$nombreUser = $_SESSION['nombreUser']; 

if($nombreUser == ''){
    header('Location: index.php');
    exit();
}

include('menu.php');
?>
<html>
   <head>
      <title>
      Listado de pedidos  
      </title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


      <style>
         .box{
            --pinkMarti: #a41242; 
            width: auto;
            height: auto;
            margin: auto;
            margin-top: -15px;
            padding: 20px;
            border-radius: 20px;

         }
         .head{
            padding: 20px;
            border-radius: 40px;
            text-align: center;
            box-shadow: 0 0 10px black;
            width: auto;
            margin: auto;
            background-color: var(--pinkMarti);
            margin-bottom: 10px;
            color: white;
            font-size: 50px;
            font-family: "Metal Mania", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .yei {
            display: grid;
            grid-template-columns: repeat(5, 1fr); 
            align-items: center;
         }

         .zelda {
            display: contents; 
         }

         .zelda_sk{
            padding: 10px;
            border: 2px solid var(--pinkMarti); 
            text-align: center; 
         }

         .zelda span{
            padding: 10px;
            border: 2px solid var(--pinkMarti); 
            text-align: center;
            background-color: var(--pinkMarti);
            color: white; 
         }

         .botonDelate{ 
            padding: auto; 
            margin: auto;
            background-color: var(--rojoPeligro);
            cursor: pointer;
            color: white;
         }

         .botonCreate{
            padding: auto; 
            margin: auto;
            background-color: #0e921c;
            cursor: pointer;
            color: white;
            height: 40px;
            width: 170px;
            font-size: x-large;
         }
         .boton.Edit{
            padding: auto; 
            margin: auto;
            background-color: #eff548;
            cursor: pointer;
            color: black;
         }
         .boton.rev{
            padding: auto; 
            margin: auto;
            background-color: #afbff0;
            cursor: pointer;
            color: black;
         }

         .head_fr{
            display: flex;
            padding: 15px;
            border-radius: 35px;
            box-shadow: 0 0 10px black;
            width: 500px;
            height: 70px;
            margin: auto;
            margin-bottom: 10px;
            background-color: var(--pinkMarti);
            color: white;
            font-size: x-large;
            text-align: center;
            font-family: "Metal Mania", system-ui;
            font-weight: 400;
            font-style: normal;
            flex-direction: column;
        }
        .brinco{
            margin-bottom: 6px;
        }

      </style>

      <script src="jquery-3.3.1.min.js"></script>
      <script>
        
      </script>

   </head>

   <body>

   <?php
      require "funciones/conecta.php"; 
      $con = conecta();
      $sql = "SELECT * FROM pedidos WHERE status = 1";
      $res = $con->query($sql);
      $num = $res->num_rows; 
   ?>
      
      <div class="box">
         <h1 class="head"> Lista de pedidos de MartisCorp (<?php echo"$num"; ?>) S.A. de C.V. </h1>
         <div class="yei">
            <div class="zelda">
               <span>--Id--</span>
               <span>--Fecha--</span>
               <span>--Cliente--</span>
               <span>--Status--</span>
               <span>--Detalles--</span>
            </div>
            <?php
               while($row = $res-> fetch_array()){
                  $id_pedido = $row["id"];
                  $fecha = $row["fecha"];
                  $id_cliente = $row["id_cliente"];
                  
                  $sql2 = "SELECT * FROM clientes WHERE id = '$id_cliente'";
                  $res2 = $con->query($sql2);
                  $row2 = $res2-> fetch_array();

                  $nombre = $row2["nombre"];
                  $apellidos = $row2["apellidos"];
                  
                  echo "<div class='zelda fila$id_pedido'>";
                  echo "<div class='zelda_sk'>$id_pedido</div>";
                  echo "<div class='zelda_sk'>$fecha</div>";
                  echo "<div class='zelda_sk'>$nombre $apellidos</div>";
                  echo "<div class='zelda_sk'> Cerrado </div>";
                  echo "<div class='zelda_sk'> <input class=\"boton rev\" type=\"submit\" value=\"Detalles\" onclick=\"window.location.href='pedidos_detalles.php?id_pedido=$id_pedido'\"></div>";
                  echo "</div>"; 
   
               }

            ?>
         </div>
      </div>
      
      </body>
</html>

   