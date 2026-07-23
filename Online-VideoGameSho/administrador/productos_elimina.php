
<?php

  //productos_elimina.php 
   require "funciones/conecta.php";
   $con = conecta();

   //Cachar variables

   $id = $_REQUEST['id'];


   $sql = "UPDATE productos SET eliminado  = 1 WHERE id = $id";
   $res = $con->query($sql);


   if ($res){
      echo "Eliminación exitosa";
   }
   else{
      echo "Eliminación incompleta";
   }

   //Se necesitaría el Header si utilizams el otro metodo donde se refresca la página
   //header("Location: empleados_lista.php");
   
?>
