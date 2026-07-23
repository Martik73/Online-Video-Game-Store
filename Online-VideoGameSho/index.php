<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marti'sShop</title>

<style>
    html{
        background-color: #e2d9e7;
    }
    section{
        --purpleMarti: #1c0332;
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        padding: 20px;
        align-items: center;
        justify-content: center;
        font-size: large;
    }
    .promo img{
        height: 200px;
        width: 600px;
        border: solid 10px var(--purpleMarti);
        margin: 20px;
    }
    .boxin{
        display: flex;
        flex-direction: column;
        padding: 10px;
        background-color: white;
        border-radius: 30px;
        text-align: center;
        align-items: center;
        box-shadow: 0 4px 8px black;
        width: 250px;
        border: 10px solid var(--purpleMarti);
    }

    .boxOfproductos{
        display: grid;
        grid-template-columns: repeat(3, 1fr); 
        gap: 100px;
        margin: 0 auto; 
    }
    img{
        height: 150px;
        width: 150px;
        border: solid 3px var(--purpleMarti);
        border-radius: 10px;
    }
    .miniboxin{
        box-shadow: 0 4px 8px black;
        border-radius: 10px;
        margin: 10px;
        padding: 10px;
        background-color: var(--purpleMarti);
        color: white;
        
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
        transition: .4s ease;
    }
    button:hover{
        transform: scale(1.4);
    }
    .canti{
        border-radius: 10px;
        height: 20px;
        justify-content: center;
        align-items: center;
        width: 40px;
        text-align: center;
    }
    .end{
        border: 4px solid var(--purpleMarti);
        border-radius: 20px;
        width: 100%;
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
        border: solid 5px var(--purpleMarti); 
    }
    .botonrev{
        background-color: var(--purpleMarti);
        color: white;
        cursor: pointer; 
        border-radius: 10px;
        font-size: large;
    }
    .picture img{
        transition: .4s ease ;
    }
    .picture img:hover{
        transform: scale(1.8);
    }
</style>

<script src="jquery-3.3.1.min.js"></script>
<script>
    function agregarCarro(id){
        var cantidad = $(`#cantidad_${id}`).val();
        var name = $('#cantidad_'+id).data('name');

        $.ajax({
                    url     : 'insertarProducto.php',
                    method: 'POST',
                    dataType: 'text',
                    data: { cantidad: cantidad, id: id, name: name},
                    success : function(res){
                        console.log(res);

                        if(res == 1){
                            $('#mensajeMal').html('¡Inicia sesión para poder agregar productos!').fadeIn();
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
</head>
<body>
    <section>
        <?php 
        if (isset($_SESSION['nombreUser']) && $_SESSION['nombreUser'] != '') {
            $nombreUser = $_SESSION['nombreUser'];
            $idUser = $_SESSION['idUser'];
            include('menu.php');
        } else {
            $nombreUser = "";
            include('menuNoLog.php');
        }
        
        require "funciones/conecta.php";
        $con = conecta();
        ?>
            
        <div class="promo">
            <?php
            $sql= "SELECT * FROM promociones WHERE eliminado = 0 ORDER BY RAND() LIMIT 7";
            $res = $con->query($sql);
            $row = $res-> fetch_array();
                $num = $res->num_rows; 
                $archivo = $row["archivo"];

                echo '<img src="administrador/archivos/' .$archivo. '">';
            ?> 

        </div>
        <div class="boxOfproductos">
        <?php
            $sql= "SELECT * FROM productos WHERE eliminado = 0 ORDER BY RAND() LIMIT 6";
            $res = $con->query($sql);
            $num = $res->num_rows;
            while($row = $res-> fetch_array()){
                $id = $row["id"];
                $nombre = $row["nombre"];
                $codigo = $row["codigo"];
                $costo = $row["costo"];
                $archivo_New = $row["archivo_New"];
            
                echo "<div class='boxin'> 
                        <div class='miniboxin' ><input class=\"botonrev\" type=\"submit\" value=\"$nombre\" onclick=\"window.location.href='productos_detalles.php?id=$id'\"></div>
                        <div class=\"picture\">
                            <a href=\"productos_detalles.php?id=$id\"><img src=\"administrador/archivos/$archivo_New\"></a>
                        </div>
                        <div class='miniboxin'> $ $costo </div>
                            <input class=\"canti\" type=\"number\" name=\"cantidad\" id=\"cantidad_$id\" min=\"1\" value=\"1\" data-name=\"$nombre\">
                            <button href=\"javascript:void(0);\" onclick=\"agregarCarro('$id')\">Agregar</button>
                            <div class=\"mensaje Mess$id\"></div>
                            <div class=\"mensaje Bien Mess$id\"></div>
                        <div class='miniboxin'> -- $codigo -- </div>
                </div>";
            }
            ?>
            
        </div>
        <div id="mensajeMal"></div>
        <div id="mensajeBien"></div>
        <div class="end"> 
            -- <a href="derechos.html">Todos los derechos reservados 2024</a> --
            -- <a href="terminos.html">Terminos y condiciones</a> --
            -- <a href="politicas.html">Politicas de privacidad</a> --
            -- <a href="redes.html">Redes sociales</a> --
        </div>
    </section>
</body>
</html>




