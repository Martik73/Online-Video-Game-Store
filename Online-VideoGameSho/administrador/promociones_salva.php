
<?php
   //empleados_salva.php
   require "funciones/conecta.php";
   $con = conecta();

   //Cachar variables

   $nombre = $_REQUEST['nombre'];
      
      //Img- (lA explicación de como funcina esto esta en Archivos Aux)
      $file_name = $_FILES['archivo']['name'];    
      $file_tmp = $_FILES['archivo']['tmp_name'];  

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

   $archivo_Ori = $file_name;
   $archivo = $fileNameUnique;

   $sql = "INSERT INTO promociones (nombre, archivo) 
   VALUES('$nombre','$archivo')";
   $res = $con->query($sql);

   header("Location: promociones_lista.php");
 
?>