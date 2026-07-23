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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quantico:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>

    <script src="jquery-3.3.1.min.js"></script>
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
            height: auto;
            width: auto;
            border: 5px solid var(--blueMArti);
            margin-top: 20px;
        }
        tr{
            border: 3px solid var(--purpleMarti);
            text-align: center; 
            padding: 10px;
            
        }
        .info{
            font-size: x-large;
            color: var(--purpleMarti);
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
        }

    </style>
</head>
<body>
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
                  
        if($rol == 1){
          $rol='Gerente';
        }
         else if($rol==2){
            $rol='Ejecutivo';
        }
?>
    
<section>
    <h1>Detalles de empledo -MartisCorp-</h1>
    
    <br><table class="letra">
        <tr>
            <td colspan="2">
                <h2>Detalles del empleado con ID: -- <?php echo"$id";?> --</h2>
            </td>
        </tr>    
        <tr class="info">
            <td>
                <img src="archivos/<?php echo"$archivo_New"; ?>">
                <p>Nombre: | <?php echo"$nombre $apellidos"; ?> |</p>
            </td>
            <td>
                <p>Correo: | <?php echo"$correo"; ?> |</p>
                <p>Rol: | <?php echo"$rol"; ?> |</p>
                <p>ID único: | <?php echo"$id"; ?> |</p>
            </td>
        </tr>

    </table>
    <input class="boton" type="submit" value="Back to List"  onclick="window.location.href='empleados_lista.php';">
</section>



</body>
</html>