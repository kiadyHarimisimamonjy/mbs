<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSB tools | Voyage</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://mbs.test/plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="http://mbs.test/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="http://mbs.test/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="http://mbs.test/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="http://mbs.test/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="http://mbs.test/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="http://mbs.test/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="http://mbs.test/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="http://mbs.test/plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="http://mbs.test/plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://mbs.test/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-boxed">
    <!-- Site wrapper -->
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-user"></i>
              <span>profile</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              <div class="user-panel mt-3 pb-3 ">
                <div class="image">
                  <img src="http://mbs.test/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="#" class=" text-dark">Alexander Pierce</a>
                </div>
              </div>


              <div class="dropdown-divider"></div>


              <a href="#" class="dropdown-item">
                <i class="fas fa-tools mr-2"></i> Parametre de Profile
              </a>


              <a href="#" class="dropdown-item">
                <i class="fas fa-ellipsis-h mr-2"></i> Autres
              </a>

              <div class="dropdown-divider"></div>

              <a href="../../../login/index.html" class="dropdown-item">
                <i class="fas fa-power-off mr-2"></i> Deconexion
              </a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.navbar -->











      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-secondary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index.php" class="brand-link text-center">
          <span class="brand-text font-weight-bold fst-italic">MSB tools</span>
          <i class="nav-icon fas  fa-tools"></i>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">


          <!-- Sidebar Menu -->
          <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="../../index.php" class="nav-link">
                  <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>



              <li class="nav-item">
                <a href="#" class="nav-link">
                  <!-- <i class="nav-icon fas fa-edit"></i> -->
                  <p>
                    ADMIN SERVICE
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Personnels</p>
                    </a>
                  </li>
				   <li class="nav-item">
                    <a href="{{ route('boats.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Bateau </p>
                    </a>
                  </li>
				   <li class="nav-item">
                    <a href="{{ route('places.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Place</p>
                    </a>
                  </li>

                 <li class="nav-item">
                    <a href="{{ route('counters.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Guichet</p>
                    </a>
                  </li>
                 <li class="nav-item">
                    <a href="{{ route('itineraries.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Parcours </p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <!-- <i class="nav-icon fas fa-copy"></i> -->
                  <p>
                    Reservations
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../../pages/reservation/nouvelle_reservation.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Nouvelle Reservation</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../../pages/reservation/liste_reservation.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste des Reservations </p>
                    </a>
                  </li>

                </ul>
              </li>


              <li class="nav-item">
                <a href="#" class="nav-link">
                  <!-- <i class="nav-icon fas fa-edit"></i> -->
                  <p>
                    Depenses
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../../pages/depense/demande_depense.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Demande de depense </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../../pages/depense/liste.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste des Depenses </p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <!-- <i class="nav-icon fas fa-copy"></i> -->
                  <p>
                    Caisse
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../../pages/caisse/ouverture.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ouverture de Caisse</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../../pages/caisse/fermeture.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Fermeture de Caisse
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../../pages/caisse/bilan.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Bilan de Caisse
                      </p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <!-- <i class="nav-icon fas fa-copy"></i> -->
                  <p>
                    Voyages
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../../pages/voyage/ajouter_voyage.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ajouter un Voyage</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../../pages/voyage/liste_voyage.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Liste des Voyages
                      </p>
                    </a>
                  </li>

                </ul>
              </li>




            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>




    <script>
      myitems=document.querySelectorAll(".nav-item")
      mylinks=document.querySelectorAll("nav-link")
    </script>




























        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> beta 0.3
            </div>
            <strong>Copyright &copy; 2021 <a href="#">MSB tools</a>.</strong>

        </footer>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->








    <!-- jQuery -->
    <script src="http://mbs.test/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="http://mbs.test/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="http://mbs.test/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="http://mbs.test/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="http://mbs.test/plugins/moment/moment.min.js"></script>
    <script src="http://mbs.test/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="http://mbs.test/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="http://mbs.test/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="http://mbs.test/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="http://mbs.test/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="http://mbs.test/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="http://mbs.test/plugins/dropzone/min/dropzone.min.js"></script>
    <!-- AdminLTE App -->
    <script src="http://mbs.test/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="http://mbs.test/dist/js/demo.js"></script>
    <!-- Page specific script -->







</body>

</html>
