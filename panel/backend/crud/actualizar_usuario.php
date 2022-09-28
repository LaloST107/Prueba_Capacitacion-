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
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['ap_paterno'];
    $apellido_materno = $_POST['ap_materno'];
    $sexo = $_POST['sexo_usuario'];
    $rol = $_POST['rol'];
    $email = $_POST['email_usuario'];
    $password = $_POST['confirm_password_usuario'];

    $id_usuario = $_POST['id_usuario'];
    $texto_cambia_password = ($password == '' ? '' : ", password_usuario='$password'");

    $query_text = "UPDATE usuarios SET nombre_usuario='$nombre', ap_paterno_usuario='$apellido_paterno', ap_materno_usuario='$apellido_materno', sexo_usuario='$sexo', rol_usuario='$rol', email_usuario='$email'".$texto_cambia_password." WHERE id_usuario='$id_usuario'";
    $query_res = mysqli_query($conexion, $query_text);

    if(!$query_res){
        echo '<script>alert("Error al actualizar el usuario. Falló nuestro servidor, intente nuevamente, por favor.");</script>';
    }//end if falló la actualización
    else{
        echo '<script>alert("¡Usuario actualizado exitosamente!");</script>';
    }//end else falló la actualización
    mysqli_close($conexion);
    echo '<script> window.location = "../../pages/usuarios.php";</script>';

?>
