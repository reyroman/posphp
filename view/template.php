<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Ventas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="view/img/template/icono-negro.png">
  <!-- PLUGINS CSS -->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="view/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="view/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="view/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="view/dist/css/skins/_all-skins.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="view/plugins/iCheck/all.css">

  <!-- Datarange picker -->
  <link rel="stylesheet" href="view/bower_components/bootstrap-datepicker/daterangepicker.css">

  <!-- Morris Chart -->
  <link rel="stylesheet" href="view/bower_components/morris.js/morris.css">

     <!-- Google Font -->
     <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  
  <!-- PLUGINS JAVASCRIPT -->


  <!-- jQuery 3 -->
  <script src="view/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- SlimScroll -->
  <script src="view/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

  <!-- FastClick -->
  <script src="view/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="view/dist/js/adminlte.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="view/dist/js/demo.js"></script>

  <!-- DataTables -->
  <script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="view/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="view/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <!-- SweetAlert -->
  <script src="view\plugins\sweetalert\sweetalert.min.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="view/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
<script src="view/plugins/input-mask/jquery.inputmask.js"></script>
<script src="view/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="view/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- JQuery Number  -->
  <script src="view/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker -->
  <script src="view/bower_components/moment/min/moment.min.js"></script>
  <script src="view/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

   <!-- Morris.js chart -->
  <script src="view/bower_components/raphael/raphael.min.js"></script>
  <script src="view/bower_components/morris.js/morris.min.js"></script>

   <!-- ChartJS http://www.chartjs.org/-->
   <script src="view/bower_components/chart.js/Chart.js"></script>



 
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
  <!-- Site wrapper -->


  <?php

  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    echo '<div class="wrapper">';

    // Cabezote
    include "modules/header.php";
    // Menu
    include "modules/menu.php";
    // Contenido
    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "categorias" ||
        $_GET["ruta"] == "dolar" ||
        $_GET["ruta"] == "productos" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "ventas" ||
        $_GET["ruta"] == "editar-venta" ||
        $_GET["ruta"] == "crear-venta" ||
        $_GET["ruta"] == "reportes" ||
        $_GET["ruta"] == "salir"
      ) {

        include "modules/" . $_GET["ruta"] . ".php";
      } else {
        include "modules/404.php";
      }
    } else {
      include "modules/inicio.php";

    }
    // Footer
  
    include "modules/footer.php";

    echo "</div>";

  } else {
    include "modules/login.php";
  }
  ?>


  <!-- ./wrapper -->
  <script src="view/js/template.js"> </script>
  <script src="view/js/usuarios.js"> </script>
  <script src="view/js/categorias.js"> </script>
  <script src="view/js/dolar.js"> </script>
  <script src="view/js/productos.js"> </script>
  <script src="view/js/clientes.js"> </script>
  <script src="view/js/ventas.js"> </script>
  <script src="view/js/reportes.js"> </script>


</body>

</html>