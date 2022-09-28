<?php
	//incluye el archivo de conexion
    include './conexion.php';

    //Para utilizar variables de sesión
    session_start();

    //Obtenemos lo que hayamos pasado en los campos
    // print("<pre>".print_r($_POST,true)."</pre>");
    $email = $_POST['usuario'];
    $password = $_POST['pass'];

    // Consulta a nuestra tabla usuarios
    $query_text = 'SELECT * FROM usuarios WHERE email_usuario="'.$email.'" AND password_usuario="'.$password.'"';

    // Obtenemos el resultado del query
    $query_res = mysqli_query($conexion, $query_text);
    // print("<pre>".print_r($query_res,true)."</pre>");

    if(mysqli_num_rows($query_res) == 0){
		echo '<script>alert("Usuario y/o contraseña incorrectos");</script>';
		session_destroy();
		echo '<script> window.location="../../login.html"; </script>';
	}//end if no hay resultados
	else{
		$datos = mysqli_fetch_array($query_res, MYSQLI_ASSOC);
        // print("<pre>".print_r($datos,true)."</pre>");
		$_SESSION['usuario_id'] = $datos['id_usuario'];
		$_SESSION['usuario_rol'] = $datos['rol_usuario'];
        $_SESSION['usuario_nombre'] = $datos['nombre_usuario'];
        //  aqui abajo le movi
		$_SESSION['usuario_nombre_completo'] = $datos['nombre_usuario'].' '.$datos['ap_paterno_usuario'].' '.$datos['ap_materno_usuario'];
		$_SESSION['usuario_email'] = $datos['email_usuario'];
		$_SESSION['usuario_sexo'] = $datos['sexo_usuario'];

		//Se libera el objeto de resultados
		mysqli_free_result($query_res);
		//Se cierra la conexión
		mysqli_close($conexion);

		echo '<script> window.location="../../pages/dashboard.php"; </script>';
	}//end else hay resultados
