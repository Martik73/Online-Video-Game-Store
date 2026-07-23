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


<title>Alta de productos MartisCorp</title>

<script src="jquery-3.3.1.min.js"></script>

<script> //Zona de JavaScript
 
 function validaFormulario() {
            let nombre = document.getElementById('nombre').value;
            let codigo = document.getElementById('codigo').value;
            let descripcion = document.getElementById('descripcion').value;
            let costo = document.getElementById('costo').value;
            let stock = document.getElementById('stock').value;
            let archivo_Ori = document.getElementById('archivo_Ori').value;
            
            
            if(stock == ""|| codigo == "" || descripcion =="" || costo=="" || nombre=="" || archivo_Ori==""){
                $('.aviso.Mal').html('¡Faltan campos por llenar!');
                setTimeout("$('.aviso.Mal').html('');", 5000);
           }

           
           else{
                $('.aviso.Bien').html('¡Registro completado!');
                setTimeout("$('.aviso.Bien').html('');", 5000);

                document.forma01.method= 'post';
                document.forma01.action= 'productos_salva.php';
                document.forma01.submit();

            }
          
    }
    
        <?php
            require "funciones/conecta.php";
            $con = conecta();
            $sql = "SELECT * FROM productos WHERE eliminado = 0"; 
            $res = $con->query($sql);
        ?>
        function sale(){
            var codigo = $('#codigo').val();

            /* Aca va el Ajax */
            $.ajax({
                    url     : 'funciones/validaCodigoPrAlta.php',
                    method: 'POST',
                    dataType: 'text',
                    data: { codigo: codigo },
                    success : function(res){
                        console.log(res);

                        if(parseInt(res) != 0){
                            $('#mensaje').html('¡El codigo - '+codigo+' - ya esta en uso!');
                            setTimeout("$('#mensaje').html('');", 5000);
                            $('#codigo').val('');
                        }
                    },
            })
            
        }

    


</script>

<style>

        section{
            --redMarti: #560606;
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
        }

        h1{
            padding: 20px;
            border-radius: 20px;
            width: 550px;
            margin: auto;
            text-align: center;
            background-color: var(--redMarti);
            margin-bottom: 20px;
            color: white;
        }

        .boton{
            width: 100px;
            height: 40px;
            background-color: var(--redMarti);
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
            font-size: medium;
            font-family: monospace;
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
        .imagenBoton{
            color: white;
            background-color: var(--redMarti);
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
        <h1>Alta de prodcutos --MartisCorp--</h1>
        <div class="aviso Bien"></div>

        <div> --- <input class="boton" type="submit" value="Back to List" onclick="window.location.href='productos_lista.php';"> --- </div>

        <h2> Llena todos los campos para completar el registro </h2>

        <form enctype="multipart/form-data" class="form" name="forma01" method="post" action="productos_salva.php" >
            
            <input class="camp" type="text" name="nombre" id="nombre" placeholder="Nombre del producto" /><br>
            <input onblur="sale()" class="camp" type="text" name="codigo" id="codigo" placeholder="Código del producto" /><br>
            <div id="mensaje"></div>
            <input class="camp" type="text" name="descripcion" id="descripcion" placeholder="Descripción del producto" /><br>
            <input class="camp" type="text" name="costo" id="costo" placeholder="Costo del producto" /><br>
            <input class="camp" type="text" name="stock" id="stock" placeholder="Stock del producto" /><br>
            <div class="campRaro">Foto del prodcuto ---<input type="file" id="archivo_Ori" name="archivo_Ori" />---</div>
            <br>
            <input class="botonAD" onclick="validaFormulario(); return false;" type="submit" value="Salvar" />        
            <div class="aviso Mal"></div>
        </form>
        </section>
    <br><br>
</body>
</html>