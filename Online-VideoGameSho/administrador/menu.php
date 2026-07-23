<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">
    <title>Siii</title>

<style>
    .boxMenu{
        --purpleMarti: #1c0332;
        display: flex;
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



</style>

</head>
<body>
<div class="boxMenu">
    <div >
        <input class="botonMenu" type="submit" value="Inicio" onclick="window.location.href='bienvenido.php';">
        <input class="botonMenu" type="submit" value="Empleados" onclick="window.location.href='empleados_lista.php';">
        <input class="botonMenu" type="submit" value="Productos" onclick="window.location.href='productos_lista.php';">
        <input class="botonMenu" type="submit" value="Promociones" onclick="window.location.href='promociones_lista.php';">
        <input class="botonMenu" type="submit" value="Pedidos" onclick="window.location.href='pedidos_lista.php';">
        <input class="botonMenu Exit" type="submit" value="Salir" onclick="window.location.href='salir.php';">

    </div>
</div>

</body>
</html>