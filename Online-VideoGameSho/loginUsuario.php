<?php
session_start();
// Verificar si la sesión está iniciada
if (isset($_SESSION['nombreUser']) && $_SESSION['nombreUser'] != '') {
    header('Location: index.php');
    exit(); // Detener el script después de redirigir
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">
    <script src="jquery-3.3.1.min.js"></script>

<script>
    function validaFormulario() {
            let correo = document.getElementById('correo').value;
            let pass = document.getElementById('pass').value;
            
            if( correo == "" || pass ==""){
                $('#mensaje').html('¡Faltan campos por llenar!');
                setTimeout("$('#mensaje').html('');", 5000);
           }

           
           else{

                $.ajax({
                    url     : 'funciones/validaUsuario.php',
                    method: 'POST',
                    dataType: 'text',
                    data: { correo: correo, pass: pass },
                    success : function(res){
                        console.log(res);

                        if(parseInt(res) == 0){
                            $('#mensaje').html('¡Datos incorrectos o inexistentes!');
                            setTimeout("$('#mensaje').html('');", 5000);
                            return;
                        }
                         window.location.href="index.php";
                        
                    },
                })
                
            }
          
    }
</script>


<style>
    section{
        --purpleMarti: #1c0332;
        --blueMArti: #e1e0f4;
        display: flex;
        width: 95%;
        height: 100vh;
        background-color: var(--purpleMarti);
        border-radius: 70px;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin: auto;
        padding: 20px;
    }
    h1{
        display: grid;
        position: relative;
        background-color: var(--blueMArti);
        padding: 20px;
        width: 50vw;
        border-radius: 45px;
        margin: auto;
        margin-bottom: -20px;
        text-align: center;
        box-shadow:  0px 0px 15px 5px black;
        font-size: 50px;
        font-family: "Metal Mania", system-ui;
        font-weight: 400;
        font-style: normal;
        color: var(--purpleMarti);
    }
    form{
        display: flex;
        width: 90%;
        height: 90%;
        background-color: var(--blueMArti);;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 45px;
    }

    h2{
        display: grid;
        background-color: var(--purpleMarti);
        color: white;
        padding: 15px;
        width: 17vw;
        margin: auto;
        border-radius: 45px;
        margin-bottom: 30px;
        font-size: large;
    }

    input{
        display: grid;
        margin: auto;
        margin-bottom: 10px;
        width: 40vw;
        border-radius: 40px;
        text-align: center;
        height: 50px;
        border: solid var(--purpleMarti) 5px;
    }
    #mensaje{
        font-size: x-large;
        font-family: monospace;
        color: white;
        background-color: red;
        margin-top: 5px;
        text-align: center;
        border-radius: 20px;
        height: auto;
        }
    .boton{
        width: 200px;
        height: 50px;
        background-color: #1c0332;
        cursor: pointer;
        color: white;
        margin: 10px auto;
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: x-large;
        border: solid 5px black;
    }
</style>
</head>




<body>
    
    <section>
    <h1>Incio de Sesión Usuario MartisCorp </h1>
        <form name="formInicio" method="post"  window.location.href="index.php">
            <div>
                <h2>Inicio de sesión</h2>
                <input type="text" name="correo" id="correo" placeholder="Ingrese el correo">
                <input type="password" name="pass" id="pass" placeholder="Ingrese la contraseña">

                <input class="boton" onclick="validaFormulario(); return false;" type="submit" value="Iniciar sesión" />
                <div id="mensaje"></div>
            </div>
        </form>
    </section>
</body>
</html>