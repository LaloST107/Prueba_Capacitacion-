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
        else{
            $id_usuario = $_GET['iu'];
            include '../backend/admin/conexion.php';
            $query_text = 'SELECT * FROM usuarios WHERE id_usuario = '.$id_usuario;
            $query_res = mysqli_query($conexion, $query_text);
            $usuario = mysqli_fetch_array($query_res, MYSQLI_ASSOC);
        }//end else no es admon el usuario
    }//end else existe una sesión iniciada
    mysqli_close($conexion);
    // print("<pre>".print_r($usuario,true)."</pre>");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Actualizar usuario - Ay Que Perros</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favi.ico" type="image/x-icon" />

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:slateblue;">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./dashboard.php">
                <div class="sidebar-brand-text mx-3"><img class="img-fluid" src="../img/logo_admin.jpg"></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php
                if($_SESSION['usuario_rol'] == 1){
                    echo '
                    <li class="nav-item active">
                        <a class="nav-link" href="usuarios.php">
                            <i class="fas fa-fw fa-user-circle"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    ';
                }//end if el usuario es admon
            ?>
            <li class="nav-item">
                <a class="nav-link" href="razas.php">
                    <i class="fas fa-fw fa-dog"></i>
                    <span>Catálogo de Razas</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sub-menu-peliculas" aria-expanded="true" aria-controls="sub-menu-peliculas">
                    <i class="fas fa-fw fa-bone"></i>
                    <span>Perros</span>
                </a>
                <div id="sub-menu-peliculas" class="collapse" aria-labelledby="sub-menu-peliculas-title" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Géneros</h6>
                        <a class="collapse-item" href="tennis_mujer.php">Machos</a>
                        <a class="collapse-item" href="tennis_hombre.php">Hembras</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ofertas.php">
                    <i class="fas fa-fw fa-paw"></i>
                    <span>Tipos de pelajes</span>
                </a>
            </li> -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background-color:gray;">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background-color:black;">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white-600 small"><?php echo $_SESSION['usuario_nombre_completo']; ?></span>
                                <img class="img-profile rounded-circle" src="../img/<?= (($_SESSION['usuario_sexo'] == 'M') ? 'undraw_profile_2.svg' : 'undraw_profile_3.svg') ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mi perfil
                                </a>
                                <a class="dropdown-item" href="cambiar.php">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cambiar contraseña
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Editar usuario</h1>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form class="user" action="../backend/crud/actualizar_usuario.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3">
                                        <label>Nombre: </label>
                                        <input type="text" class="form-control form-control-user" name="nombre" value="<?= $usuario['nombre_usuario'] ?>" placeholder="Eduardo" required>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label>Apellido paterno: </label>
                                        <input type="text" class="form-control form-control-user" name="ap_paterno" value="<?= $usuario['ap_paterno_usuario'] ?>" placeholder="Salazar" required>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label>Apellido materno: </label>
                                        <input type="text" class="form-control form-control-user" name="ap_materno" value="<?= $usuario['ap_materno_usuario'] ?>" placeholder="Tecuapacho" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2 mb-3">
                                        <label>Sexo del usuario: </label>
                                        <select class="form-control" name="sexo_usuario" required>
                                            <option value="M" <?= ($usuario['sexo_usuario'] == 'M' ? 'selected' : '') ?>>Masculino</option>
                                            <option value="F" <?= ($usuario['sexo_usuario'] == 'F' ? 'selected' : '') ?>>Femenino</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Rol del usuario: </label>
                                        <br>
                                        <input type="radio" name="rol" id="rol-administrador" value="1" <?= ($usuario['rol_usuario'] == 1 ? 'checked' : '') ?>>
                                        <label for="rol-administrador"> Administrador</label>
                                        <br>
                                        <input type="radio" name="rol" id="rol-usuario" value="2" <?= ($usuario['rol_usuario'] == 2 ? 'checked' : '') ?>>
                                        <label for="rol-usuario"> Usuario</label>
                                        <!-- es para el id y actualizar campo fantasma -->
                                        <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">

                                    </div>
                                    <div class="col-sm-3">
                                        <label>Correo electrónico: </label>
                                        <input type="email" class="form-control form-control-user" name="email_usuario" value="<?= $usuario['email_usuario'] ?>" placeholder="nombre@gmail.com" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Contraseña: </label>
                                        <input type="password" class="form-control form-control-user" id="password_usuario" name="password_usuario" value="" placeholder="*************" onkeyup="check();">
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Confirmar contraseña: </label>
                                        <input type="password" class="form-control form-control-user" id="confirm_password_usuario" name="confirm_password_usuario" value="" placeholder="*************" onkeyup="check();">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 text-right">
                                        <span id="mensaje_password"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 text-right">
                                        <a href="usuarios.php" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <span class="text">Cancelar</span>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 text-left">
                                        <button type="submit" class="btn btn-info btn-icon-split" id="btn-registrar">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Actualizar usuario</span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer " style="background-color:black;">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © AyQuePerros 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de cerrar la sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Al cerrar sesión serás redireccionado al login. ¿Deseas continuar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../backend/admin/cerrar_sesion.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <script>
        var check = function(){
            var campo_password = document.getElementById('password_usuario');
            var campo_confirmar_password = document.getElementById('confirm_password_usuario');
            if(campo_password.value == campo_confirmar_password.value){
                document.getElementById('mensaje_password').innerHTML = 'Las contraseñas coinciden';
                document.getElementById('mensaje_password').style.color = 'green';
                document.getElementById('btn-registrar').disabled = false;
            }//end if contraseñas coinciden
            else{
                document.getElementById('mensaje_password').innerHTML = 'Las contraseñas no coinciden';
                document.getElementById('mensaje_password').style.color = 'red';
                document.getElementById('btn-registrar').disabled = true;
            }//end else contraseñas coinciden
        }//end function
    </script>

</body>

</html>
