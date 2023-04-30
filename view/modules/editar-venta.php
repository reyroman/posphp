<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>Editar venta</h1>

    <ol class="breadcrumb">

      <li> <a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a> </li>

      <li class="active">Editar Venta</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!-- FORMULARIO  -->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">

              <div class="box">

                <?php
                 
                 $item = "id";
                 $valor = $_GET["idVenta"];

                 $venta = VentasController::ctrMostrarVentas($item, $valor);

                 $item = "id";
                 $valor = $_GET["idVenta"];

                 $venta = VentasController::ctrMostrarVentas($item, $valor);

                 $itemUsuario = "id";
                 $valorUsuario = $venta["id_vendedor"];

                 $vendedor = UserController::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                 $itemCliente = "id";
                 $valorCliente = $venta["id_cliente"];

                 $cliente = ClienteController::ctrMostrarClientes($itemCliente, $valorCliente);
                
                 $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];

                 $totalBolivares = $venta["total"] * $venta["valor_dolar"];

                ?>

                <!-- ENTRADA DEL VENDEDOR -->

                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor" 
                      value="<?php echo $vendedor["nombre"]; ?>" readonly>

                      <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"];?>">

                  </div>
                </div>
         

                <!-- ENTRADA DEL CODIGO DE VENTA -->

                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    

                      <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"];?>" readonly>
                    
                                      

                  </div>
                </div>

                <!-- ENTRADA DEL CLIENTE -->

                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                      <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                      <?php

                      $item = null;
                      $valor = null;

                      $clientes = ClienteController::ctrMostrarClientes($item, $valor);

                      foreach ($clientes as $key => $value) {
                        
                        echo ' <option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                      }

                      ?>


                    </select>

                    <!-- <input type="text" class="form-control" id="agregarCliente" name="agregarCliente" value=""
                      placeholder="Agregar cliente   " readonly> -->

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs"
                        data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar
                        cliente</button></span>

                  </div>
                </div>

                <!-- ENTRADA DE AGREGAR PRODUCTO -->

                <div class="form-group row nuevoProducto">

                <?php
                 
                $listaProducto = json_decode($venta["productos"],true);

               // var_dump($listaProducto);

                foreach ($listaProducto as $key => $value) {

                    $item = "id";
                    $valor = $value["id"];
                    $orden = "id";

                    $respuesta = ProductController::ctrMostrarProductos($item, $valor, $orden);
    
                    $stockAnterior = $respuesta["stock"] + $value["cantidad"];
                   
                  echo  '<div class="row" style="padding: 5px 15px;">
			
			       <div class="col-xs-6" style="padding-right:0px;">

                    <div class="input-group">

                      <span class="input-group-addon"><button type="botton" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                      <input type="text" class="form-control nuevaDescripcionProducto"  value="'.$value["descripcion"].'" idProducto="'.$value["id"].'" name="agregarProducto" placeholder="Descripcion del producto" readonly required>
                    
					  </div>

                  </div>
                  
                   <div class="col-xs-3">

                    <input type="number" class="form-control nuevaCantidadProducto" 
                    name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" 
                    stock="'.$stockAnterior.'" nuevoStock="'.$value["stock"].'" required>

                  </div>

                  <!-- PRECIO DEL PRODUCTO -->

                   <div class="col-xs-3 ingresoPrecio" style="padding-left:0px;">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                      <input type="text"  class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
		  
                    </div>

					</div>

                  </div>';

                }
                
                ?>

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!-- BOTON PARA AGREGAR PRODUCTO -->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>
                
                <div class="row">

                <!-- IMPUESTOS Y TOTAL -->

                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>
                        <tr>
                          <th>Impuestos</th>
                          <th>Total dolares</th>
                        </tr>

                      </thead>

                      <tbody>
                        <tr>
                          <!-- IMPUESTO DE VENTA -->
                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="number" class="form-control " name="nuevoImpuestoVenta"
                                id="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" required>

                                <input type="hidden" name="nuevoValorDolar" id="nuevoValorDolar" dolar=""
                                value="<?php echo $venta["valor_dolar"]; ?>" required>

                                <input type="hidden"  name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" 
                                value="<?php echo $venta["impuesto"]; ?>" required>

                                <input type="hidden"  name="nuevoPrecioNeto" id="nuevoPrecioNeto" 
                                value="<?php echo $venta["neto"]; ?>" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                            </div>
                          </td>

                          <!-- TOTAL DE VENTA -->

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control " name="nuevoTotalVenta" id="nuevoTotalVenta"
                                 total="<?php echo $venta["neto"];?>" value="<?php echo $venta["total"]; ?>" readonly required>

                                 <input type="hidden" id="totalVenta" value="<?php echo $venta["total"]; ?>" name="totalVenta">

                            </div>
                          </td>

                        </tr>

                        <tr>
                          <!-- BOLIVARES -->
                          <td style="width: 50%">
                          <h4>Total bolivares:</h4>
                          </td>

                          <!-- TOTAL DE VENTA EN BOLIVARES -->

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control" value="<?php echo $totalBolivares; ?>" 
                              name="nuevoTotalBolivares" id="nuevoTotalBolivares" total="" readonly  required>

                              <input type="hidden" id="totalVentaBolivares" value="<?php echo $totalBolivares;?>" 
                              name="totalVentaBolivares">

                            </div>
                          </td>

                        </tr>

                        
                      </tbody>

                    </table>

                    

                  </div>

                </div>

                <hr>
                <!-- ENTRADA METODO DE PAGO -->

                <div class="form-group row">

                  <div class="col-xs-6" style="padding-right: 0px">

                    <div class="input-group">

                      <select class="form-control" name="nuevoMetodoPago" id="nuevoMetodoPago" required>

                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TD">Tarjeta Debito</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="Biopago">Biopago</option>
                        <option value="PagoMovil">Pago Movil</option>
                        <option value="Transferencia">Transferencia</option>

                      </select>

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>

            </div>

          </form>

          <?php
           
           $editarVenta = new VentasController();
           $editarVenta -> ctrEditarVenta();
          
          ?>

        </div>

      </div>

      <!-- TABLA DE PRODUCTOS -->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaVentas" width=100%>
              <thead>
                <tr>
                  <th style="width:10px ">#</th>
                  <th>Código</th>
                  <th>Cód barras</th>
                  <th>Descripción</th>
                  <th>Categoría</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>
              </thead>

            </table>


          </div>

        </div>

      </div>

    </div>

  </section>

</div>

<!-- /.content-wrapper -->

<!--  MODAL AGREGAR CLIENTE -->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!-- MODAL HEADER -->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!-- FIN DE MODAL HEADER -->

        <div class="modal-body">

          <div class="box-body">

            <!-- INGRESO DE CEDULA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevaCedula" id="nuevaCedula"
                  placeholder="Ingresar cedula" required>

              </div>

            </div>

            <!-- INGRESO DE NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre"
                  required>

              </div>

            </div>

            <!-- INGRESO DE EMAIL -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email">

              </div>

            </div>

            <!-- INGRESO DE TELEFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar telefono"
                  data-inputmask="'mask':'(9999)-999 9999'" data-mask>

              </div>

            </div>

            <!-- INGRESO DE DIRECCION -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección">

              </div>

            </div>

            <!-- INGRESO DE FECHA DE NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento"
                  placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask>

              </div>

            </div>

          </div> <!-- MODAL BODY -->

        </div> <!-- MODAL BOX -->

        <!-- PIE DEL MODAL -->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="
        modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>
        </div>

        <?php
        $crearCliente = new ClienteController();
        $crearCliente->ctrCrearCliente();
        ?>


      </form>

    </div> <!-- MODAL CONTENT -->

  </div> <!-- CLASS MODAL DIALOG -->

</div> <!--MODAL AGREGAR CLIENTE -->