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
        margin: auto;
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
    .si{
        height: 51.2px;
        vertical-align: middle;
        width: 51.2px;
    }



</style>

</head>
<body>
<div class="topleft">
    <img class="si" src="administrador\archivos\Mark_of_the_Slayer.webp"> 
    <?php echo $nombreUser?>
</div>
<div class="boxMenu">
    <div >
        <input class="botonMenu" type="submit" value="Home" onclick="window.location.href='index.php';">
        <input class="botonMenu" type="submit" value="Productos" onclick="window.location.href='productos.php';">
        <input class="botonMenu" type="submit" value="Contacto" onclick="window.location.href='contacto.php';">
        <input class="botonMenu" type="submit" value="Log in" onclick="window.location.href='loginUsuario.php';">

    </div>
</div>

</body>
</html>