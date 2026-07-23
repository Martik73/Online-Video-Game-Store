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
      Listado de promociones  
      </title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


      <style>
         .box{
            --greenMarti: #0a9958; 
            --rojoPeligro: #ee1a1a;
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
            background-color: var(--greenMarti);
            margin-bottom: 10px;
            color: white;
            font-size: 50px;
            font-family: "Metal Mania", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .yei {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* Para definir 8 columnas del mismo ancho */
            align-items: center;
         }

         .zelda {
            display: contents; 
         }

         .zelda_sk{
            padding: 10px;
            border: 2px solid var(--greenMarti); 
            text-align: center; 
         }

         .zelda span{
            padding: 10px;
            border: 2px solid var(--greenMarti); 
            text-align: center;
            background-color: var(--greenMarti);
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
            background-color: var(--greenMarti);
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
        
        function eliminaFila(id){
            if(confirm("¿Deseas eliminar este registo?")){

               $.ajax({
                    url     : 'promociones_elimina.php',
                    type    : 'post',
                    dataType: 'text',
                    data    : { id: id },

                    success: function(res){
                     console.log(res);
                        if(res){
                           $('.fila'+id).hide();  
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
      $sql = "SELECT * FROM promociones WHERE eliminado = 0";
      $res = $con->query($sql);
      $num = $res->num_rows; 
   ?>
      
      <div class="box">
         <h1 class="head"> Lista de promociones de MartisCorp (<?php echo"$num"; ?>) S.A. de C.V. </h1>
         <div class="head_fr">
            <form name="creation" action="promociones_alta.php" method="post">
               <div class="brinco">---Para agregar una nueva promoción---</div>
               <div>--<input class="botonCreate" type="submit" value="Create" onclick="promociones_alta.php">--</div>
            </form>
         </div>
         <div class="yei">
            <div class="zelda">
               <span>--Id--</span>
               <span>--Nombre--</span>
               <span>--Detalles--</span>
               <span>--Editar--</span>
               <span>--Eliminar--</span>
            </div>
            <?php
               while($row = $res-> fetch_array()){
                  $id = $row["id"];
                  $nombre = $row["nombre"];

                  
                  echo "<div class='zelda fila$id'>";
                  echo "<div class='zelda_sk'>$id</div>";
                  echo "<div class='zelda_sk'>$nombre</div>";
                  echo "<div class='zelda_sk'> <input class=\"boton rev\" type=\"submit\" value=\"Detalles\" onclick=\"window.location.href='promociones_detalles.php?id=$id'\"></div>";
                  echo "<div class='zelda_sk'> <input class=\"boton Edit\" type=\"submit\" value=\"Editar\" onclick=\"window.location.href='promociones_edita.php?id=$id'\"></div>";
                  echo "<div class='zelda_sk'> <input class=\"botonDelate\" type=\"submit\" value=\"Delete\" onclick=\"eliminaFila('$id')\"> </div>";
                  echo "</div>"; 
   
               }

            ?>
         </div>
      </div>
      
      </body>
</html>

   