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
    $pass_nueva=$_POST['pass_nueva'];
    $usuario_id=$_SESSION['usuario_id'];


    $query_text = "UPDATE usuarios SET password_usuario='$pass_nueva' WHERE id_usuario='$usuario_id'";

    $query_res = mysqli_query($conexion, $query_text);
    if(!$query_res){
        echo '<script>alert("Error al actualizar la contraseña.");</script>';
    }//end if falló la actualización
    else{
            echo '<script>alert("¡Contraseña actualizada exitosamente!");</script>';
    }//end else falló la actualización
    mysqli_close($conexion);
    echo '<script> window.location = "../../pages/usuarios.php";</script>';



?>
