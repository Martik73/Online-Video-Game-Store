<?php
  session_start();
  if (isset($_SESSION['nombreUser']) && $_SESSION['nombreUser'] != '') {
      $nombreUser = $_SESSION['nombreUser'];
      include('menu.php');
  } else {
      include('menuNoLog.php');
  }
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
    <script>
         function agregarCarro(id){
            var cantidad = $('#cantidad_'+id).val();
            var name = $('#cantidad_'+id).data('name');

            $.ajax({
                        url     : 'insertarProducto.php',
                        method: 'POST',
                        dataType: 'text',
                        data: { cantidad: cantidad, id: id, name: name},
                        success : function(res){
                            console.log(res);

                            if(res == 1){
                                $('#mensajeMal').html('Inicia sesión para poder agregar productos').fadeIn();
                                setTimeout(() => {
                                $('#mensajeMal').fadeOut();
                                }, 5000);
                            }
                            else{
                                $('#mensajeBien').html('¡Producto agregado al carrito!: <br><br> --- '+ res +' ---').fadeIn();
                                setTimeout(() => {
                                $('#mensajeBien').fadeOut();
                                }, 3000);
                            }

                        },
                    })
    }
    </script>
    <style>
        section{
            --purpleMarti: #1c0332;
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
            width: 550px;
            text-align: center;
            background-color: var(--purpleMarti);
            margin: 5px;
            color: white;
        }
        h2{
            padding: 10px;
            border-radius: 10px;
            width: 650px;
            margin: auto;
            text-align: center;
            background-color: var(--blueMArti);
            margin-bottom: 10px;
            color: white;
        }
        table{
            height: 75%;
            width: 75%;
            padding: 2px; 
            border: 3px solid var(--purpleMarti); 
            background-color: white; 
            font-size: large;
            line-height: 40px;
            background-color: #afbff0;
        }
        img{
            height: 40%;
            width: 40%;
            border: 5px solid var(--blueMArti);
            margin-top: 20px;
            transition: .4s ease;
        }
        img:hover{
            transform: scale(1.7);
        }
        tr{
            border: 3px solid var(--purpleMarti);
            text-align: center; 
            padding: 10px;
            
        }
        .info{
            font-size: x-large;
            color: var(--purpleMarti);
            overflow: hidden;
        }
        td{
            padding: 10px;
            text-align: center;
            border: 3px solid var(--purpleMarti); 
            width: 40%;
            
        }
        .boton{
            width: 250px;
            height: 50px;
            background-color: var(--purpleMarti);
            cursor: pointer;
            color: white;
            margin-top: 10px;
            font-size: x-large;
            transition: .4s ease;
        }
        .boton:hover{
            transform: scale(1.3);
        }
        #mensajeBien{
            position: fixed;
            top: 45%; 
            left: 30%; 
            z-index: 1000;
            color: white;
            background-color: green;
            padding: 20px;
            text-align: center;
            border-radius: 10px ;
            display: none;
            font-size: xx-large;
            border: solid 5px var(--purpleMarti);
        }
        #mensajeMal{
            position: fixed;
            top: 45%; 
            left: 30%; 
            z-index: 1000;
            background-color: red;
            padding: 20px;
            text-align: center;
            border-radius: 20px ;
            display: none;
            color: white;
            font-size: xx-large;
            border: solid 4px var(--purpleMarti);
        }
        button{
            width: auto;
            height: 30px;
            background-color: green;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 10px;
            color: white;
            border: solid 2px black;
            font-size: large;
        }
        .canti{
            border-radius: 10px;
            height: 30px;
            justify-content: center;
            align-items: center;
            width: 60px;
            text-align: center;
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
</head>
<body>
<?php
      require "funciones/conecta.php";
      $con = conecta();
      $id = $_REQUEST['id'];
      $sql = "SELECT * FROM productos WHERE id = $id";
      $res = $con->query($sql);
      $num = $res->num_rows; 
      
        $row = $res-> fetch_array();
        $id = $row["id"];
        $nombre = $row["nombre"];
        $codigo = $row["codigo"];
        $costo = $row["costo"];
        $descripcion = $row["descripcion"];
        $stock = $row["stock"];
        $archivo_New = $row["archivo_New"];
                
?>
    
<section>
    
    <table class="letra">
        <tr>
            <td colspan="2">
                <h2>Detalles del producto con ID: -- <?php echo"$id";?> --</h2>
            </td>
        </tr>    
        <tr class="info">
            <td>
                <img src="administrador/archivos/<?php echo"$archivo_New"; ?>">
                <p>Nombre: | <?php echo"$nombre"; ?> |</p>
                <p>Código: | <?php echo"$codigo"; ?> |</p>
            </td>
            <td>
                <p>Costo: | $ <?php echo"$costo"; ?> |</p>
                <p>Disponibilidad: | <?php echo"$stock"; ?> |</p>
                <p>Descripción:<br> <?php echo"$descripcion"; ?> </p>
                <p> <?php echo "<input class=\"canti\" type=\"number\" name=\"cantidad\" id=\"cantidad_$id\" min=\"1\" value=\"1\" data-name=\"$nombre\"> "?> </p>
                <p> <?php echo "<button href=\"javascript:void(0);\" onclick=\"agregarCarro('$id')\" >-- Agregar --</button>"?> </p>
            </td>
        </tr>

    </table>
    <div id="mensajeMal"></div>
    <div id="mensajeBien"></div>
    <input class="boton" type="submit" value="Back" onclick="window.history.back()">
</section>
<div class="end"> 
      -- <a href="derechos.html">Todos los derechos reservados 2024</a> --
      -- <a href="terminos.html">Terminos y condiciones</a> --
      -- <a href="politicas.html">Politicas de privacidad</a> --
      -- <a href="redes.html">Redes sociales</a> --
</div>



</body>
</html>