<?php
    $idUser = $_SESSION['idUser'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">
    <title>Marti'sShop</title>

<style>
    .boxMenu{
        --purpleMarti: #1c0332;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        width: 90%;
        height: 8vh;
        border-radius: 40px;
        padding: auto;
        margin: auto;
        margin-bottom: 10px; 
    }
    .botonMenu{
        margin: 10px;
        height: 45px;
        width: 130px;
        cursor: pointer;
        font-size: large;
        border-radius: 20px;
        background-color: white; 
        border: 4px solid var(--purpleMarti);
        font-family: "Metal Mania", system-ui;
        font-weight: 400;
        font-style: normal;
        
    }
    .botonMenu:hover {
        background: var(--purpleMarti); 
        color: white;
    }
    .botonMenu.Exit:hover {
        background: red; 
        color: white;
    }
    .topleft{
        display: grid;
        position: relative;
        margin-bottom: -50px;
        margin-left: -87%;
        display: inline-block;
        vertical-align: middle;
        font-family: "Metal Mania", system-ui;
        font-weight: 400;
        font-style: normal;
    }
    img.si{
        height: 51.2px;
        vertical-align: middle;
        width: 51.2px;
    }
    .topright{
        display: grid;
        position: relative;
        margin-bottom: -50px;
        margin-left: 84%;
        display: inline-block;
        vertical-align: middle;
    }
    #mensajeMal{
        position: fixed;
        top: 45%; 
        left: 40%; 
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


</style>

<script src="jquery-3.3.1.min.js"></script>
<script>

    function revisionCarroVacio(idUser){
        $.ajax({
                    url     : 'revisionCarroVacio.php',
                    method: 'POST',
                    dataType: 'text',
                    data: { idUser: idUser},
                    success : function(res){
                        console.log(res);
                        if(res == 1){
                            $('#mensajeMal').html('¡El carrito esta vacio!').fadeIn();
                            setTimeout(() => {
                            $('#mensajeMal').fadeOut();
                            }, 5000);
                        }
                        else if(res == 2 ){
                            window.location.href='carritoPrimis.php';
                        }
                    },
                })
    }

</script>

</head>
<body>
<div class="topleft">
    <img class="si" src="administrador\archivos\Mark_of_the_Slayer.webp"> 
    <?php echo $nombreUser?>
</div>
<div class="topright">
    <img class="si" src="administrador\archivos\controller.png"> 
</div>
<div class="boxMenu">
    <input class="botonMenu" type="submit" value="Home" onclick="window.location.href='index.php';">
    <input class="botonMenu" type="submit" value="Productos" onclick="window.location.href='productos.php';">
    <input class="botonMenu" type="submit" value="Contacto" onclick="window.location.href='contacto.php';">
    <input class="botonMenu" type="submit" value="Carrito" onclick="revisionCarroVacio(<?php echo $idUser ?>)">
    <input class="botonMenu" type="submit" value="Bienvenido" onclick="window.location.href='bienvenido.php';">
    <input class="botonMenu Exit" type="submit" value="Salir" onclick="window.location.href='salir.php';">
</div>
<div id="mensajeMal"></div>
</body>
</html>