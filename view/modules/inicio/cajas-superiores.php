<?php

$item = null;
$valor = null;
$orden = "id";

$ventas = VentasController::ctrSumaTotalVentasBs();

// $categorias = CategoriaController::ctrMostrarCategorias($item, $valor);
// $totalCategorias = count($categorias);

$ventasDolares = VentasController::ctrSumaTotalVentasDolares();


$clientes = ClienteController::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ProductController::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3>$<?php echo number_format($ventasDolares["total"],2); ?></h3>

      <p>Ventas en Dolares</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="ventas" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-blue-gradient">
    
    <div class="inner">
      
      <h3>Bs <?php echo number_format($ventas["total"],2); ?></h3>

      <p>Ventas en Bolivares</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="ventas" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalClientes); ?></h3>

      <p>Clientes</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-ios-cart"></i>
    
    </div>
    
    <a href="productos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>