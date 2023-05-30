<div class="content-wrapper">

<section class="content-header">

    <h1>Crear entrada</h1>

    <ol class="breadcrumb">

      <li> <a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a> </li>

      <li class="active">Crear entrada de productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!-- FORMULARIO  -->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioMovimientos">

            <div class="box-body">

              <div class="box">

                <!-- ENTRADA DEL USUARIO -->

                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoUser" 
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUser" value="<?php echo $_SESSION["id"]; ?>">

                  </div>
                </div>

                    <!-- ENTRADA DEL TIPO DE MOVIMIENTO -->

                    <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-refresh"></i></span>

                    <input type="text" class="form-control" id="nuevoTipoMovimiento" name="nuevoTipoMovimiento"
                      value="Entrada" readonly>

                   

                  </div>
                </div>


                <!-- ENTRADA DEL CODIGO DE VENTA -->

                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $movimientos = MovimientosController::ctrMostrarMovimientos($item, $valor);

                    if (!$movimientos) {

                      echo '<input type="text" class="form-control" id="nuevaEntrada"
                       name="nuevaEntrada" value="101" readonly>';
                    } else {

                      foreach ($movimientos as $key => $value) {

                      }

                      $codigo = $value["codigo"] + 1;

                      echo '<input type="text" class="form-control" 
                      id="nuevaEntrada" name="nuevaEntrada" value="' . $codigo . '" readonly>';

                    }

                    ?>

                  </div>
                </div>

                   <!-- ENTRADA DE DESCRIPCION -->

                   <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                    <input type="text" class="form-control" id="nuevaDescripcionMovimiento" name="nuevaDescripcionMovimiento"
                      value="" palceholder="Descripción del movimiento" required>

                    <input type="hidden" name="idDescripcionMovimiento" value="">

                  </div>
                </div>

                <!-- ENTRADA DE AGREGAR PRODUCTO -->

                <div class="form-group row nuevoProducto">

                </div>

                <input type="hidden" id="listaProductos2" name="listaProductos2">

                <!-- BOTON PARA AGREGAR PRODUCTO -->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar Entrada</button>

            </div>

          </form>

          <?php

          $guardarEntrada = new MovimientosController();
          $guardarEntrada->ctrCrearEntrada();

          ?>

        </div>

      </div>

      <!-- TABLA DE PRODUCTOS -->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaMovimientos" width=100%>
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