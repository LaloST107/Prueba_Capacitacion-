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
        include '../backend/admin/conexion.php';
        $usuario_id = $_SESSION['usuario_id'];
        $query_text = "SELECT * FROM usuarios WHERE id_usuario = '$usuario_id'";
        $query_res = mysqli_query($conexion, $query_text);
        $usuarios = array();
        if(mysqli_num_rows($query_res) != 0){
            while($datos = mysqli_fetch_array($query_res, MYSQLI_ASSOC)){
                $usuarios[] = $datos;
            }
        }
    }
    // print("<pre>".print_r($_SESSION,true)."</pre>");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perfil</title>

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
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios.php">
                            <i class="fas fa-fw fa-user-circle  "></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    ';
                }//end if el usuario es admon
            ?>
            <li class="nav-item">
                <a class="nav-link" href="./razas.php">
                    <i class="fas fa-fw fa-dog"></i>
                    <span>Catálogo Perros</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" >
            <!-- Main Content imagen ? color class="bg-success" ? -->
            <!-- <img src="../img/Olfato.png" class="img-fluid" alt="..." >      -->
            <div id="content" >
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background-color:black;">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" >
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

                                <a class="dropdown-item" href="./perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mi perfil
                                </a>
                                <a class="dropdown-item" href="./cambiar.php">
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
                <div class="container-fluid "   >
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-center bg-primary mb-4">
                        <h1 class="h2 mb-0 text-white">Mi perfil</h1>


                    </div>




                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nombre completo</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Sexo</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($usuarios as $usuario) {
                                        echo '<tr class="text-center">';

                                            echo '<td>'.
                                                    $usuario['nombre_usuario'].' '.$usuario['ap_paterno_usuario'].' '.$usuario['ap_materno_usuario'].
                                                 '</td>';

                                            echo '<td>'.
                                                    $usuario['email_usuario'].
                                                 '</td>';
                                            echo '<td>'.
                                                    (($usuario['rol_usuario'] == 1 ? 'Administrador' : 'Usuario')).
                                                 '</td>';
                                            echo '<td>'.
                                                    (($usuario['sexo_usuario'] == 'M' ? 'Masculino' : 'Femenino')).
                                                 '</td>';

                                            echo '
                                            <td>
                                                <a href="./usuario_detalles.php?iu='.$usuario['id_usuario'].'" class="btn btn-info btn-circle">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            ';
                                            echo '
                                            <td>
                                                <a href="../backend/crud/eliminar_usuario.php?iu='.$usuario['id_usuario'].'" class="btn btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                            ';
                                        echo '</tr>';
                                    }//end foreach
                                    ?>
                                </tbody>
                            </table>
                        </div>
                </div>     <!--   Cierra cardy body    -->



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer " style="background-color:black;">
                <div class="container my-auto"  >
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; AyQuePerros 2022</span>
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

</body>

</html>
