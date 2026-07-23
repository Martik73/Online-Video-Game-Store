<?php
session_start();
$nombreUser = $_SESSION['nombreUser']; 

if($nombreUser == ''){
    header('Location: index.php');
    exit();
}

include('menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenudos</title>

<style>
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
    }
    p{
        font-size: xx-large;
    }
    img{
        width: 50%;
        height: 50%;
    }

</style>


</head>
<body>
    <section>
        <div class="box">

            <table>
                <tr>
                    <td><p>¡Hola -- <?php echo $nombreUser; ?>-- bienvenido al sistema de administración!</p></td>
                    
                </tr>
                <tr>
                    <td><img src="archivos\Mark_of_the_Slayer.webp"></td>
                </tr>
            </table>

            
        </div>
    </section>
</body>
</html>