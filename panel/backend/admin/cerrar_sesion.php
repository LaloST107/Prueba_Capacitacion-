<?php
    //Retomamos la variable de sesion ya creada
    session_start();

    //Romper la sesión
    session_destroy();

    echo '
        <script>
            window.location = "../../../index.php";
        </script>
    ';
