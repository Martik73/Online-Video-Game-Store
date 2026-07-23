<?php

   $precio = "";
   $cantidad = "";
   $total = "";
   $cantidadexistente = "";
   $XD = "";
   $nuevoTotal = 0;


   $precio = $_REQUEST['precio'];
   $cantidad = $_REQUEST['newcantidad'];
   $total = $_REQUEST['total'];
   $cantidadexistente = $_REQUEST['cantidadexistente'];

   
   if ($precio === "" || $cantidad === "" || $total === "" || $cantidadexistente === "") {
     echo "Error: Datos inválidos.";
     exit;
     }

   $precio = (double) $precio;
   $cantidad = (int) $cantidad;
   $cantidadexistente = (int) $cantidadexistente;
   $total = (double) $total;


   if($cantidad > $cantidadexistente){
        $XD = $cantidad - $cantidadexistente;
        $nuevoTotal = $total + ($XD * $precio);
   }
   else if($cantidad < $cantidadexistente){
        $XD = $cantidadexistente - $cantidad;
        $nuevoTotal = $total - ($XD * $precio);
   }
   else{
          $nuevoTotal = $total;
   }

   echo "$nuevoTotal";

   
?>
