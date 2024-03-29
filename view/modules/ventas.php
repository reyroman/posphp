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
      Administrar ventas
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar ventas</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        
      <a href="crear-venta">
        <button class="btn btn-primary">
          Agregar venta al detal
        </button>

      </a>
      <a href="crear-venta-mayor">
        <button class="btn btn-primary">
          Agregar venta al mayor
        </button>

      </a>
      <button type="button" class="btn btn-default pull-right" id="daterangeVentas-btn">

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
              <th>Tipo</th>
              <th>Cliente</th>
              <th>Vendedor</th>
              <th>Forma de pago</th>
              <th>Dolar</th>
              <th>Neto</th>
              <th>Total $</th>
              <th>Total Bs</th>
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
          
          $respuesta = VentasController::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

              foreach ($respuesta as $key => $value) {
           
            echo'<tr>
            
    <td>'.($key+1).'</td>
    <td>'.$value["codigo"].'</td>
    <td>'.$value["tipo_venta"].'</td>';

    $itemCliente = "id";
    $valorCliente = $value["id_cliente"];

    $respuestaCliente = ClienteController::ctrMostrarClientes($itemCliente, $valorCliente);

    echo'<td>'.$respuestaCliente["nombre"].'</td>';

    $itemVendedor = "id";
    $valorVendedor = $value["id_vendedor"];

    $respuestaVendedor = UserController::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

    echo'<td>'.$respuestaVendedor["nombre"].'</td>

    

    <td>'.$value["metodo_pago"].'</td>
    <td>'.number_format($value["valor_dolar"],2).'</td>
    <td>'.number_format($value["neto"],2).'</td>
    <td>'.number_format($value["total"],2).'</td>
    <td>'.number_format($value["total_bolivares"],2).'</td>
    <td>'.$value["fecha"].'</td>
  
            
      <td>
      <div class="btn-group">
  
      <button class="btn btn-info btnImprimirFactura" 
      codigoVenta="' . $value["codigo"] . '" tipoVenta="' . $value["tipo_venta"] . '"><i class="fa fa-print"></i></button>';

      if($_SESSION["perfil"] == "Administrador"){

      echo'<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'" tipoVenta="'.$value["tipo_venta"].'"><i class="fa fa-pencil"></i></button>
  
       <button class="btn btn-danger btnEliminarVenta"
         idVenta="'. $value["id"] .'"><i class="fa fa-times"></i></button>';
      }
      echo'</div>
      </td>
      </tr>'; 

          }

              
          ?>        

          </tbody>

        </table>

        <?php
 
   $eliminarVenta = new VentasController();
   $eliminarVenta -> ctrEliminarVenta();

        ?>

      </div>

    </div>

  </section>

</div>



