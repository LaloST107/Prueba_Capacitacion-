<?php
    //Variables para configuración de conexion con la BD
    $server = 'localhost';
    $bd = 'ayqueperros';
    $user = 'root';
    $pass = '';

    //Conexión a la BD
    $conexion = mysqli_connect($server, $user, $pass, $bd);

    //Verificar si no hay error de conexion
    if(!$conexion){
        die("Error de conexión: ".mysqli_connect_error());
        exit();
    }//end if conexion no existe conexión

    mysqli_query($conexion,'SET NAMES "utf8"');


// eduardo
