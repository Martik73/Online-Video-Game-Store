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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quantico:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">


<title>Edición de empleados MartisCorp</title>

<script src="jquery-3.3.1.min.js"></script>

<script> //Zona de JavaScript
 
 function validaFormulario() {
            let correo = document.getElementById('correo').value;
            let rol = document.getElementById('rol').value;
            let apellidos = document.getElementById('apellidos').value;
            let nombre = document.getElementById('nombre').value;
            
            
            if(rol == 0 || correo == "" || apellidos=="" || nombre==""){
                $('.aviso.Mal').html('¡Faltan campos por llenar!');
                setTimeout("$('.aviso.Mal').html('');", 5000);
           }

           
           else{
                $('.aviso.Bien').html('¡Registro completado!');
                setTimeout("$('.aviso.Bien').html('');", 5000);

                
                document.forma01.submit();

            }
          
    }
    
        
        function sale(){
            var correo = $('#correo').val();
            var id = $('#correo').data('id');
            /* Aca va el Ajax */
            $.ajax({
                    url     : 'funciones/validaCorreoEdicion.php',
                    method: 'POST',
                    dataType: 'text',
                    data: { correo: correo, id: id }, //Revisar esta madre data: { correo: correo, id: id },
                    success : function(res){
                        console.log(res);

                        if(parseInt(res) != 0){
                            $('#mensaje').html('¡El correo - '+correo+' - ya existe!');
                            setTimeout("$('#mensaje').html('');", 5000);
                            $('#correo').val('');
                        }
                    },
            })
            
        }
        <?php
            require "funciones/conecta.php";
            $con = conecta();
            $id = $_REQUEST['id'];
            $sql = "SELECT * FROM empleados WHERE id = $id";
            $res = $con->query($sql);
            $num = $res->num_rows; 
      
            $row = $res-> fetch_array();
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $correo = $row["correo"];
            $rol = $row["rol"];
            $archivo_Ori = $row["archivo_Ori"];
            $archivo_New = $row["archivo_New"];
                    
        ?>

    


</script>

<style>

        section{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            height: auto;
            width: auto;
            padding-top: 20px;
            padding-bottom: 20px;
            border-radius: 150px;
            font-family: "Quantico", serif;
            font-weight: 400;
            font-style: normal;
        }

        h1{
            padding: 20px;
            border-radius: 20px;
            width: 550px;
            margin: auto;
            text-align: center;
            background-color: #1c0332;
            margin-bottom: 8px;
            color: white;
        }

        .boton{
            width: 100px;
            height: 40px;
            background-color: #1c0332;
            cursor: pointer;
            color: white;
            margin: 10px auto;
            margin-top: 10px;
        }

        .form{
            width: 60%;
            height: auto;
            box-shadow: 0 0 10px rgba(28, 3, 50);
            border-radius: 50px;
            text-align: center;
            padding-top: 15px;
            padding-bottom: 15px;
            margin-top: 10px;
            font-size: large;
        }

        .camp{
            width: 80%;
            height: 50px;
            margin-top: 7px ;
            text-align: center;
            border-radius: 20px;
        }

        h2{
            padding: 10px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(28, 3, 50);
            width: 360px;
            margin: auto;
            text-align: center;
            margin-bottom: 10px;
            margin-top: 5px;
            font-size: large;
        }
   
        .botonAD{
            width: 100px;
            height: 40px;
            background-color: #0e921c;
            cursor: pointer;
            color: white;
            margin: 10px auto;
        
        }
        #mensaje{
            font-size: medium;
            font-family: monospace;
            color: white;
            background-color: red;
            margin-top: 2px;
            text-align: center;
            border-radius: 20px;
        }

        .aviso{
            font-size: large;
            font-family: monospace;
            margin-top: 2px;
            text-align: center;
            border-radius: 20px;
        }
        .aviso.Mal{
            color: white;
            background-color: red;
        }
        .aviso.Bien{
            background-color: #0e921c;
        }
        .aviso.Alert{
            background-color: #e9f01b;
            width: auto;
        }
        .imagenBoton{
            color: white;
            background-color: #1c0332;
            font-size: small;
        }
        
        .campRaro{
            display: flex;
            width: 80%;
            height: 50px;
            margin: auto;
            margin-top: 7px;
            border: 2px solid black;
            border-radius: 20px;
            justify-content: center;
            align-items: center;
        }
        

    
</style>
</head>


<body bgcolor= black>
    
    <br>
    <section>
        <h1>Edición de empleado --MartisCorp--</h1>
        <div class="aviso Bien"></div>

        <div> --- <input class="boton" type="submit" value="Back to List" onclick="window.location.href='empleados_lista.php';"> --- </div>

        <h2> Edición del empleado con ID: -  <?php echo $id ?>  - </h2>
        <h2 class="aviso Alert"> Si NO deseas cambiar la contraseña, deja el campo VACIO </h2>

        <form enctype="multipart/form-data" class="form" name="forma01" method="post" action="empleados_salvaEdicion.php?id=<?php echo $id ?>" >
            
            <input class="camp" type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre" value="<?php echo $nombre?>" /><br>
            <input class="camp" type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos" value="<?php echo $apellidos?>"/><br>
            <input onblur="sale()" class="camp" type="text" name="correo" id="correo" placeholder="Escribe tu correo"  data-id="<?php echo $id; ?>" value="<?php echo $correo?>" /><br>
            <div id="mensaje"></div>
            <input class="camp" type="password" name="pass" id="pass" placeholder="Escribe tu contraseña" /><br>
            
            <select class="camp" name="rol" id="rol">
                <option value="0" <?php echo ($rol == 0) ? 'selected' : ''; ?> >Seleccion de Rol</option>
                <option value="1" <?php echo ($rol == 1) ? 'selected' : ''; ?> > Gerente </option>
                <option value="2" <?php echo ($rol == 2) ? 'selected' : ''; ?> > Ejecutivo</option>

            </select>
            <div class="campRaro">Foto de perfil ---<input type="file" id="archivo_Ori" name="archivo_Ori" />---</div>
            <br>
            <input class="botonAD" onclick="validaFormulario(); return false;" type="submit" value="Salvar" />        
            <div class="aviso Mal"></div>
        </form>
        </section>
    <br><br>
</body>
</html>