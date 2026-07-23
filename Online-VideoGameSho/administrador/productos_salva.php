
<?php
   //empleados_salva.php
   require "funciones/conecta.php";
   $con = conecta();

   //Cachar variables

   $nombre = $_REQUEST['nombre'];
   $codigo = $_REQUEST['codigo'];
   $descripcion = $_REQUEST['descripcion'];
   $costo = $_REQUEST['costo'];
   $stock = $_REQUEST['stock'];
      
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

   $archivo_Ori = $file_name;
   $archivo_New = $fileNameUnique;

   $sql = "INSERT INTO productos (nombre, codigo, descripcion, costo, stock, archivo_Ori, archivo_New) 
   VALUES( '$nombre', '$codigo', '$descripcion' , '$costo', '$stock', '$archivo_Ori','$archivo_New')";
   $res = $con->query($sql);

   header("Location: productos_lista.php");
 
?>