
<?php
   //empleados_salva.php
   require "funciones/conecta.php";
   $con = conecta();

   //Cachar variables

   $nombre = $_REQUEST['nombre'];
   $apellidos = $_REQUEST['apellidos'];
   $correo = $_REQUEST['correo'];
   $pass = $_REQUEST['pass'];
   $rol = $_REQUEST['rol'];
      
      //Img- (lA explicación de como funcina esto esta en Archivos Aux)
      $file_name = $_FILES['archivo_Ori']['name'];    
      $file_tmp = $_FILES['archivo_Ori']['tmp_name'];  

      $arreglo = explode(".", $file_name);         
      $len = count($arreglo);                                                                                                             
      $pos = $len-1;                                                                                                    
      $exten = $arreglo[$pos];                      
    
      $dir = "archivos/";                         
      $file_encrip = md5_file($file_tmp);            

       if($file_name != ''){
            $fileNameUnique= "$file_encrip.$exten";
            copy($file_tmp, $dir.$fileNameUnique);
       }

   $passEnc= md5($pass); //Metodo mtd5 para encriptar contraseñas

   $archivo_Ori = $file_name;
   $archivo_New = $fileNameUnique;

   $sql = "INSERT INTO empleados (nombre, apellidos, correo, rol, pass, archivo_Ori, archivo_New) VALUES('$nombre','$apellidos','$correo',$rol,'$passEnc','$archivo_Ori','$archivo_New')";
   $res = $con->query($sql);

   header("Location: empleados_lista.php");
 
?>