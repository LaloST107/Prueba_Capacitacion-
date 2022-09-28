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
            include '../backend/admin/conexion.php';
            $query_text = 'SELECT * FROM raza;';
            $query_res = mysqli_query($conexion, $query_text);
            $raza = array();
            if(mysqli_num_rows($query_res) != 0){
                while($datos = mysqli_fetch_array($query_res, MYSQLI_ASSOC)){
                    $raza[] = $datos;
                }//end mientras sigan existiendo registros
        	}//end if no hay resultados
            // print("<pre>".print_r($usuarios, true)."</pre>");
        }//end else no es el admon el usuario
    }//end else existe una sesión iniciada
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

    <title>Usuarios - Ay Que Perros</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Lista de Razas</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row mb-4">
                        <div class="col-md-12 text-left">
                            <a href="raza_nueva.php" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <span class="text">Agregar raza</span>
                            </a>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h4 class="m-0 font-weight-bold text-primary text-center">Tabla de razas</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Nombre Raza</th>
                                                    <th>Enfermedades</th>
                                                    <th>forma de Orejas</th>
                                                    <th>Criado</th>
                                                    <th>País Origen</th>
                                                    <th>Descendencia</th>
                                                    <th>Num Perros</th>
                                                    <th>Editar</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php
                                                foreach ($raza as $razas) {
                                                    echo '<tr class="text-center">';

                                                        echo '<td>'.
                                                                $razas['nombre_raza'].
                                                             '</td>';

                                                             echo '<td>'.
                                                                     $razas['enfermedad_raza'].
                                                                  '</td>';

                                                                     echo '<td>'.
                                                                       (($razas['forma_orejas'] == 'L' ? 'Largas' : 'Cortas')).
                                                                         '</td>';

                                                                         echo '<td>'.
                                                                                 $razas['criado_raza'].
                                                                              '</td>';

                                                                              echo '<td>'.
                                                                                      $razas['pais_origen'].
                                                                                   '</td>';

                                                                                   echo '<td>'.
                                                                                           $razas['descendencia'].
                                                                                        '</td>';

                                                                                        echo '<td>'.
                                                                                        $razas['cantidad_raza'].
                                                                                             '</td>';

                                                                                       //
                                                                                        echo '
                                                                                        <td>
                                                                                            <a href="./raza_detalles.php?iu='.$razas['id_raza'].'" class="btn btn-info btn-circle">
                                                                                                <i class="fas fa-edit"></i>
                                                                                            </a>
                                                                                        </td>
                                                                                        ';
                                                                                        echo '
                                                                                        <td>
                                                                                            <a href="../backend/crud/eliminar_raza.php?iu='.$razas['id_raza'].'" class="btn btn-danger btn-circle">
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
<!--  apartado nuevo  -->


                                    <!--  cierrra botton-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer" style="background-color:black;">
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

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <script>
            $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No se encontraron registros",
                "infoFiltered": "(Filtrar_MAX_ de registros totales)",
                "search" : "Buscar",
                "paginate": {
                    "next" : "Siguiente",
                    "previous" : "Anterior"
                }
            }
        });
        </script>

</body>

</html>
