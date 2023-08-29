<?php
session_start();

if($_SESSION["correo"] === null){
    header("Location: ../HTML/index.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../Imagenes/favicon.png"/>
  <title>Administrador</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">      
     <style>
      /* INICIO DE EL ESTILO DE EL TRADUCTOR */

/* Quita el texto (Con la tecnologia de) */
div .skiptranslate.goog-te-gadget, .goog-te-combo .dark{
    font-size: 0%;
  }
  
  /* Quita el texto (Traductor de google) */
  div .skiptranslate.goog-te-gadget span a{
    font-size: 0;
  }
  
  /* Cambia el estilo del boton para seleccionar el idioma */
  div .goog-te-combo{
            color: #000000;
            font-weight: bold;
            cursor: pointer;
            border: none;
            border-radius: 10px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            padding: 10px 20px;
            transition: background-color 0.1s, color 0.1s;
  }
  div .goog-te-combo:hover{
    background-color: blue;
    color: #ffffff;
  }
  /* Cambia el tamaño y mueve la parte azul del traductor*/
  .VIpgJd-ZVi9od-ORHb-OEVmcd.skiptranslate , .VIpgJd-ZVi9od-ORHb{
    width: 55%;
    top: 1.3%;
    left: -52.9%;
  }
  
  /* Cambia el estilo de la lista de idiomas del menú del traductor */
  .goog-te-combo option{
    background-color: #ffffff;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    font-weight: bold;
    color: #000000;
    -webkit-o-border-radius: 10px;
    -moz-o-border-radius: 10px;
    -ms-o-border-radius: 10px;
  }
  
  /* Hace invisible la imagen de "Google" */
  a img{
    width: 0;
  }
  
  /* FIN DE EL DISEÑO DE EL TRADUCTOR */
    </style>   
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3 lowercase font-bold text-lg natural-text"><strong>SaludRural</strong></div>
      </a>

      <!-- CSS para que el texto se muestre en su estado natural -->
      <style>
        .natural-text {
          text-transform: none;
        }
      </style>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Registro de usuarios</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>


    

      <!-- Divider -->
      <li class="nav-item">
         <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <script src="../JS/traductor.js"></script>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i  class="fa fa-university"></i>
                    <span>Donaciones</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header text-gray-600"><strong>Donaciones:</strong></h6>
                        <a class="collapse-item" href="donacion_mone.php">Monetarias</a>
                        <a class="collapse-item" href="donacion_insu.php">Insumos médicos</a>
                        <a class="collapse-item" href="donacion_medi.php">Medicamentos</a>
                        <a class="collapse-item" href="donacion_equi.php">Equipos médicos</a>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="hospitales.php">
                    <i class="fa fa-hospital-o"></i>
                    <span>Hospitales</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="necesidades.php">
                    <i class="fa fa-hospital-o"></i>
                    <span>Necesidades actuales</span></a>
            </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

           

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["correo"];?></span>
<!--                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                <img class="img-profile rounded-circle" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
