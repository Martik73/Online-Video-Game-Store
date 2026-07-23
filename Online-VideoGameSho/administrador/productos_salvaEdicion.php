
<?php
   //productos_salva.php
   require "funciones/conecta.php";
   $con = conecta();

   //Cachar variables

   $id = $_REQUEST['id'];
   $nombre = $_REQUEST['nombre'];
   $codigo = $_REQUEST['codigo'];
   $costo = $_REQUEST['costo'];
   $stock = $_REQUEST['stock'];
   $descripcion = $_REQUEST['descripcion'];
   
      //Img- (lA explicación de como funcina esto esta en Archivos Aux)
   $file_name = $_FILES['archivo_Ori']['name'];    
   $file_tmp = $_FILES['archivo_Ori']['tmp_name'];  

      if($file_name != ""){

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

         $sql = "UPDATE productos SET nombre = '$nombre', 
            codigo = '$codigo', costo = '$costo', descripcion = '$descripcion', stock = '$stock', 
            archivo_Ori = '$archivo_Ori', archivo_New = '$archivo_New' WHERE id = $id";
      }
      else{ 
         $sql = "UPDATE productos SET nombre = '$nombre', 
         codigo = '$codigo', costo = '$costo', descripcion = '$descripcion', stock = '$stock' WHERE id = $id";
      }
      
      $res = $con->query($sql);
      header("Location: productos_lista.php");
 
?>