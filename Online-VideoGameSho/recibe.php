<?php

    $to = "jslocal@localhost.com"; // Cambia a tu correo de destino
    $subject = "Mensaje de contacto";
    $textoToSend = $_REQUEST['textoToSend'];
    $headers = "From: jslocal@localhost.com";

    if (!isset($_REQUEST['textoToSend']) || empty($_REQUEST['textoToSend'])) {
        die("Error: El mensaje está vacío.");
    }

    else if (mail($to, $subject, $textoToSend, $headers)) {
        echo 1;
    } else {
        echo 2;
    }

?>
