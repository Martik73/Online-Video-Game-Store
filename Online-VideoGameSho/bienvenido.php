<?php
  session_start();
  if (isset($_SESSION['nombreUser']) && $_SESSION['nombreUser'] != '') {
      $nombreUser = $_SESSION['nombreUser'];
      include('menu.php');
  } 
  else {
    header("Location:index.php");
      
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenudos</title>

<style>
     html{
        background-color: #e2d9e7;
    }
     section{
        --purpleMarti: #1c0332;
        display: flex;
        width: 95%;
        height: 100vh;
        background-color: var(--purpleMarti);
        border-radius: 70px;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin: auto;
        padding: auto;
        font-family: "Metal Mania", system-ui;
        font-weight: 400;
        font-style: normal;
    }
    .box{
        display: flex;
        width: 90%;
        height: 90%;
        background-color: white;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 45px;
        flex-direction: column;
    }
    p{
        font-size: xx-large;
    }
    img{
        width: 50%;
        height: 50%;
    }
    .topright{
            display: grid;
            position: relative;
            margin-bottom: -50px;
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

</style>


</head>
<body>
    <section>
        <div class="box">

            <table>
                <tr>
                    <td><p>¡Hola -- <?php echo $nombreUser; ?>-- bienvenido al sistema!</p></td>
                    
                </tr>
                <tr>
                    <td><img src="administrador\archivos\Mark_of_the_Slayer.webp"></td>
                </tr>
            </table>
            <div class="end"> 
                -- <a href="derechos.html">Todos los derechos reservados 2024</a> --
                -- <a href="terminos.html">Terminos y condiciones</a> --
                -- <a href="politicas.html">Politicas de privacidad</a> --
                -- <a href="redes.html">Redes sociales</a> --
                <input type="submit" class="admin" onclick="window.location.href='administrador/index.php';" value="Admin">
            </div>
        </div>
    </section>
    
</body>
</html>