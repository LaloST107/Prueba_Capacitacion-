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

    <title>Dashboard - Ay Que Perros</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favi.ico" type="image/x-icon" />



</head>

<body id="page-top ">
    <div id="wrapper"   >
        <!-- Aqui se cambia el color del lado izquirdo donde los enlaces -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar " style="background-color:slateblue;">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./dashboard.php">
                <div class="sidebar-brand-text mx-3"><img class="img-fluid" src="../img/logo_admin.jpg"></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span >Dashboard</span>
                </a>
            </li>
            <?php
                if($_SESSION['usuario_rol'] == 1){
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios.php">
                            <i class="fas fa-fw fa-user-circle"></i>
                            <span> Usuarios</span>
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
                <a class="nav-link collapsed" href="perros.php" data-toggle="collapse" data-target="#sub-menu-peliculas" aria-expanded="true" aria-controls="sub-menu-peliculas">
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
            </li> -->

            <!-- <li class="nav-item">
                <a class="nav-link" href="ofertas.php">
                    <i class="fas fa-fw fa-paw"></i>
                    <span>Tipos de pelajes</span>
                </a>
            </li> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper aqui va el de todo el contenidio bg-dark text-white   -->
        <!-- style="background-color:black;"   es mejor ya que tiene varieadad de colores -->
        <div id="content-wrapper" class="d-flex flex-column  " style="background-color:black;"  >
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar barra de arriba a color amarillo-->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background-color:teal;">
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
                <div class="container-fluid "   >
                    <!-- Page Heading  -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-white" >Ay que Perros... </h1>
                        <!-- botton para abrir la grafica -->
                        <div class="text-center">
                          <div class="btn-group" role="group" aria-label="">

                              <button id="btnBD" type="button" class="btn btn-outline-info btn-user btn-block font-weight-bold">Gráfica de Perros</button>
                          </div>
                        </div>
                 <!-- parte izquierda -->


                    </div>
                    <!-- Content Row -->
                    <div class="row"   >
                        <div class="container p-3 my-3 bg-dark text-white" >
                        <!--En este container se muestran los gráficos-->
                        <!-- <div id="contenedor" style="min-width: 320px; height: 400px; margin: 0 auto"></div> -->

                        <!--Modal para gráficos-->
                        <div id="modal-1" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                   <h5 class="modal-title"></h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <div class="modal-body">
                                   <!--En este container se muestran los gráficos-->
                                   <div id="contenedor-modal" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                               </div>
                        </div>
                        </div>
                        </div>

                   <!-- <a  href="../hc_2019/index.html">  aaa</a> -->




                   	   <h3><p>Nuevos modelos de alimentación canina<p></h3>
                    <p><img src="../img/Olfato.png" alt="imagen" width="25%"></p>
                        <br>
                  <p> Cada vez más, la comida que elegimos para nuestros perros refleja nuestra propia manera de alimentarnos. Las tendencias imperantes en la alimentación humana se ven proyectadas en la alimentación canina. Las marcas del petfood no pierden una y sacan al mercado nuevas dietas para ajustarse a las nuevas demandas: grain free, natural, ancestral, orgánico… </p>


                          <article>
                           <dd>
                             <h3>La dieta de tu perro No es una cuestión de opinión</h3>
                    <p>    <i>	 <b>"</b>   La dieta no es una cuestión de opinión: la anatomía de un perro marca sus necesidades nutricionales y sus capacidades digestivas. Tanto la forma que tienen sus dientes como la longitud de su intestino determinan el tipo de alimentos que deben formar la base de su dieta<b>"</b> </i> </p>


                        <p>Biológicamente, un perro se considera un <b>carnívoro no estricto</b>. Eso quiere decir que necesita una dieta donde el principal ingrediente sea la proteína de origen animal (la carne, para entendernos), pero tiene un sistema digestivo capaz de tolerar ingredientes de origen no animal en pequeñas cantidades.</p>
                        </dd>
                         </article>

                         <article>

                          <h2>Alzheimer en perros: el Síndrome de Disfunción Cognitiva</h2>
                     <p><img src="../img/Alzheimer.png" alt="imagen" width="25%"></P>
                     <p> <b>¿Los perros ancianos pueden sufrir Alzheimer canino?</b> La respuesta es sí. En este artículo os voy a hablar del Síndrome de Disfunción Cognitiva y la demencia senil en perros.Es muy importante aprender a reconocer sus síntomas para poder iniciar un tratamiento paliativo cuanto antes.  </p>

                     <h2>¿Existe el Alzheimer en perros?</h2>
                     <p>Los perros no viven tantos año como los humanos, pero dentro de su ciclo de vida, proporcionalmente pueden considerarse ancianos (lo que en medicina veterinaria se llama <b>perros geriátricos</b>) <b>a partir de los 7 o los 9 años.</b></p>

                      </article>

</div>



  <!-- style="background-color:black;" -->


<!-- <div class="container p-3 my-3 bg-dark text-white"> -->

<!-- </div> -->









                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer " style="background-color:black;">
                <div class="container my-auto">
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
    <a class="scroll-to-top rounded" href="dashboard.php">
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


<!-- ***************** -->


<!-- jQuery, Popper.js, Bootstrap JS -->
<script src="JQuery/jquery-3.3.1.min.js"></script>
<script src="popper/popper.min.js"></script>
<script src="Bootstrap_4/js/bootstrap.min.js"></script>
<!-- Highcharts JS -->
<script src="pluggins/Highcharts_7.0.3/code/highcharts.js"></script>
<script src="pluggins/Highcharts_7.0.3/code/modules/exporting.js"></script>
<script src="pluggins/Highcharts_7.0.3/code/modules/export-data.js"></script>

<script src="pluggins/Highcharts_7.0.3/code/modules/drilldown.js"></script>
<script src="codigoJS.js"></script>



<!-- ******************************************************************************** -->
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

</body>

</html>
