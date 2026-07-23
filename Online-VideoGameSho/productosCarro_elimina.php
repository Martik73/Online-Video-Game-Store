
<?php

   require "funciones/conecta.php";
   $con = conecta();


   $id_fila = $_REQUEST['id_fila'];
   $total = $_REQUEST['total'];
   $subt = $_REQUEST['subt'];
   

   $sql = "DELETE FROM pedidos_productos WHERE id = $id_fila";
   $res = $con->query($sql);

   $total = (double) $total;
   $subt = (double) $subt;

   $total -= $subt;

   echo "$total";
?>
