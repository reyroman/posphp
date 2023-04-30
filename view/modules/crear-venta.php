<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>Crear venta</h1>

    <ol class="breadcrumb">

      <li> <a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a> </li>

      <li class="active">Crear venta</li>

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

                <!-- ENTRADA DEL VENDEDOR -->

                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>
                </div>


                <!-- ENTRADA DEL CODIGO DE VENTA -->

                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $ventas = VentasController::ctrMostrarVentas($item, $valor);

                    if (!$ventas) {

                      echo '<input type="text" class="form-control" id="nuevaVenta"
                       name="nuevaVenta" value="10001" readonly>';
                    } else {

                      foreach ($ventas as $key => $value) {

                      }

                      $codigo = $value["codigo"] + 1;

                      echo '<input type="text" class="form-control" 
                      id="nuevaVenta" name="nuevaVenta" value="' . $codigo . '" readonly>';
                    }



                    ?>

                  </div>
                </div>

                <!-- ENTRADA DEL CLIENTE -->

                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                      <option value="">Seleccionar Cliente</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $clientes = ClienteController::ctrMostrarClientes($item, $valor);

                      foreach ($clientes as $key => $value) {

                        echo ' <option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';

                      }

                      ?>


                    </select>

                    <!-- <input type="text" class="form-control" id="agregarCliente" name="agregarCliente" value=""
                      placeholder="Ingrese el número de cedula del cliente">

                      <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs"
                        data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Buscar</button></span> -->

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs"
                        data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar
                        cliente</button></span>

                  </div>
                </div>

                <!-- ENTRADA DE AGREGAR PRODUCTO -->

                <div class="form-group row nuevoProducto">

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
                          
                          <th>Valor impuesto</th>
                          <th>Total dolares</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>
                          <!-- IMPUESTO DE VENTA -->

                         
                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="number" class="form-control " name="nuevoImpuestoVenta"
                                id="nuevoImpuestoVenta" value="0" required>

                              <input type="hidden" name="nuevoValorDolar" id="nuevoValorDolar" dolar="" required>

                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>



                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>


                            </div>
                          </td>

                          <!-- TOTAL DE VENTA -->

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control " name="nuevoTotalVenta" id="nuevoTotalVenta"
                                total="" placeholder="00000" readonly required>

                              <input type="hidden" id="totalVenta" name="totalVenta">

                            </div>
                          </td>

                        </tr>

                        <tr>

                        <!-- BOLIVARES -->
                          <td style="width: 50%">
                            <h4>Total bolivares:</h4>
                          </td>

                          <!-- TOTAL DE VENTA EN BOLIVARES -->

                          <td style="width: 40%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control" name="nuevoTotalBolivares"
                                id="nuevoTotalBolivares" total="" readonly placeholder="00000" required>

                              <input type="hidden" id="totalVentaBolivares" name="totalVentaBolivares">

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
                        <option value="BP">Biopago</option>
                        <option value="PM">Pago Movil</option>
                        <option value="REF">Transferencia</option>

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

              <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

            </div>

          </form>

          <?php

          $guardarVenta = new VentasController();
          $guardarVenta->ctrCrearVenta();

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