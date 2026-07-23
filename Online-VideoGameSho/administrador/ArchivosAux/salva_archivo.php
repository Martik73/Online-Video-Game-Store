<?php

    $file_name = $_FILES['archivo']['name'];    //Nombre Real del archivo
    $file_tmp = $_FILES['archivo']['tmp_name'];  //Nombre/ruta temporal del archivo

    //A aprtir de aqui es una manera para obtener la extensión

    $arreglo = explode(".", $file_name);         //Separa el nombre para obtener la extensión    Ejemplo Foto.jpg -----> [Foto] . [jpg]
    $len = count($arreglo);                     //Numero de elementos                            Ejemplo  -------> [Foto] Posición 0 del arreglo, [jpg]Pos 1 del arreglos---> 
                                                                                                    //Por lo tanto la cantidad de elementos del arreglo es 2   
    $pos = $len-1;                              //Posición a buscar      Por lo tanto si el arreglo es de 2 elementos busca el TotalElemn - 1 
                                                                            //para buscar el la posición 1 donde se encuentra la extensión jpg
    $exten = $arreglo[$pos];                      //Extensión    Aqui guardas la extensión jpg
    
    
    $dir = "archivos/";                         //Carpeta donde se guaradan los archivos
    $file_encrip = md5_file($file_tmp);            //Nombre del archivo encriptado para volverlo unico

    echo "file_name:  $file_name   <br><br>";
    echo "file_tmp :  $file_tmp    <br><br>";
    echo "exten:        $exten         <br><br>";
    echo "file_encrip:   $file_encrip    <br><br>";

    if($file_name != ''){
        $fileNameUnique= "$file_encrip.$exten";
        copy($file_tmp, $dir.$fileNameUnique);
        echo "fileNameUnique: $fileNameUnique  <br>";

        //echo "Esta guardado en: $dir$fileNameUnique <br>";
     }


?>