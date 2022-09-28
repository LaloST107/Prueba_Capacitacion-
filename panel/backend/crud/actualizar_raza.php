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

    // print("<pre>".print_r($_POST,true)."</pre>");  datos de la tabla de razas
    $nombre = $_POST['raza'];
    $enfermedad= $_POST['enfermedad_perro'];
    $criado = $_POST['criado_perro'];
    $forma = $_POST['orejas_perro'];
    $pais= $_POST['pais_perro'];
    $descendencia = $_POST['descendencia_perro'];
    $num = $_POST['num_raza'];


     $id_raza = $_POST['id_raza'];

    $query_text = "UPDATE raza SET nombre_raza='$nombre', enfermedad_raza='$enfermedad',criado_raza='$criado',forma_orejas='$forma', pais_origen='$pais',   descendencia='$descendencia' , cantidad_raza='$num' WHERE id_raza= '$id_raza'";
    $query_res = mysqli_query($conexion, $query_text);

    if(!$query_res){
        echo '<script>alert("Error al registrar la raza. Falló nuestro servidor, intente nuevamente, por favor.");</script>';
    }//end if falló la inserción
    else{
        echo '<script>alert("¡Raza registrada de manera exitosa!");</script>';
    }//end else falló la inseción
    mysqli_close($conexion);
    echo '<script> window.location = "../../pages/razas.php";</script>';

?>
