<?php
 
if($_SESSION["perfil"] == "Especial"){

  echo'<script>

  window.location = "inicio";
  
  </script>';
}
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar inventario
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar inventario</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        
      <a href="crear-entrada">
        <button class="btn btn-primary">
          Agregar entrada de mercancia
        </button>

      </a>
      <button type="button" class="btn btn-default center pull-right" id="daterangeMovimientos-btn">

      <span>
        <i class="fa fa-calendar"></i> Rango de fecha
      </span>

      <i class="fa fa-caret-down"></i>

      </button>
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

          <thead>
            <tr>

              <th style="width:10px">#</th>
              <th>Código</th>
              <th>Usuario</th>
              <th>Movimiento</th>
              <th>Descripción</th>
              <th>Fecha</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tbody>

          <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
            
          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }
          
          $respuesta = MovimientosController::ctrRangoFechasMovimientos($fechaInicial, $fechaFinal);

              foreach ($respuesta as $key => $value) {
           
            echo'<tr>
            
    <td>'.($key+1).'</td>
    <td>'.$value["codigo"].'</td>';

    $itemUsuario = "id";
    $valorUsuario = $value["id_usuario"];

    $respuestaUsuario = UserController::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

    echo'<td>'.$respuestaUsuario["nombre"].'</td>';

   

   echo ' <td>'.$value["tipo_movimiento"].'</td>
          <td>'.$value["descripcion"].'</td>
          <td>'.$value["fecha"].'</td>
  
            
      <td>
      <div class="btn-group">
  
      <button class="btn btn-info btnImprimirMovimiento" 
      codigoMovimiento="' . $value["codigo"] . '"><i class="fa fa-print"></i></button>';

      if($_SESSION["perfil"] == "Administrador"){

      echo'<button class="btn btn-danger btnEliminarMovimiento"
         idMovimiento="'. $value["id"] .'"><i class="fa fa-times"></i></button>';
      }
      echo'</div>
      </td>
      </tr>'; 

          }

              
          ?> 

          </tbody>

        </table>

        <?php
 
    $eliminarMovimiento = new MovimientosController();
    $eliminarMovimiento -> ctrEliminarMovimiento();

        ?>

      </div>

    </div>

  </section>

</div>



