<?php
    session_start();
    if(!isset($_SESSION['usuario_id'])){
        echo '
                <script>
                    alert("No tienes permiso para acceder a esta vista. Inicia sesión, por favor...");
                    window.location ="../login.html";
                </script>
            ';
    }//end if existe una sesión iniciada
    else{
        if($_SESSION['usuario_rol'] != 1){
            echo '
                <script>
                    alert("Permiso denegado, no tienes las credenciales para acceder a esta zona. ¡ALEJATE!");
                    window.location ="./dashboard.php";
                </script>
                ';
        }//end if no es admon el usuario
    }//end else existe una sesión iniciada

    include '../admin/conexion.php';

    // print("<pre>".print_r($_POST,true)."</pre>");
    //la priemera es una variable x y el segundo nombre es de la base de datos
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['ap_paterno'];
    $apellido_materno = $_POST['ap_materno'];
    $sexo = $_POST['sexo_usuario'];
    $rol = $_POST['rol'];
    $email = $_POST['email_usuario'];
    $password = $_POST['confirm_password_usuario'];

    $query_text = "INSERT INTO usuarios VALUES(NULL, '$nombre', '$apellido_paterno', '$apellido_materno', '$sexo', '$rol', '$email', '$password');";
    $query_res = mysqli_query($conexion, $query_text);

    if(!$query_res){
        echo '<script>alert("Error al registrar el usuario. Falló nuestro servidor, intente nuevamente, por favor.");</script>';
    }//end if falló la inserción
    else{
        echo '<script>alert("¡Usuario registrado exitosamente!");</script>';
    }//end else falló la inseción
    mysqli_close($conexion);
    echo '<script> window.location = "../../pages/usuarios.php";</script>';

?>
