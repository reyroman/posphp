<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar productos
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar productos</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          Agregar producto
        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">

          <thead>
            <tr>

              <th style="width:10px">#</th>
              <th>Código</th>
              <th>Código de barras</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Agregado</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tbody>


          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--  MODAL AGREGAR PRODUCTO -->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!-- MODAL HEADER -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar producto</h4>

        </div>
        <!-- FIN DE MODAL HEADER -->

        <div class="modal-body">
          <div class="box-body">

            <!-- INGRESO DE CATEGORIA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>

                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = CategoriaController::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {

                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- INGRESO DE CODIGO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo"
                  placeholder="Codigo" readonly required>

              </div>

            </div>

            <!-- INGRESO DE CODIGO DE BARRAS-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoCodigoBarras" name="nuevoCodigoBarras"
                  placeholder="Ingresar codigo de barras" required>

              </div>

            </div>

            <!-- INGRESO DE DESCRIPCION -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDescripcion"
                  placeholder="Ingresar descripcion" id="nuevaDescripcion" required>

              </div>

            </div>

            <!-- INGRESO DE STOCK -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock"
                  required>



              </div>

            </div>

            <!-- ENTRADA PARA PRECIO DE COMPRA -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra"
                    min="0" step="any" placeholder="Precio de compra" required>

                </div>

              </div>

              <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta"
                    min="0" step="any" placeholder="Precio de venta" required>

                </div>

                <br>

                <!-- CHECKBOX PARA PORCENTAJE -->

                <div class="col-xs-6">

                  <div class="form-group">

                    <label>

                      <input type="checkbox" class="minimal porcentaje" checked>
                      Utilizar procentaje
                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6" style="padding:0">

                  <div class="input-group">

                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div> <!-- MODAL BODY -->
          </div> <!-- MODAL BOX -->
         </div> 
         <!--FIN MODAL BODY -->
          <!-- PIE DEL MODAL -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="
        modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar producto</button>
          </div>

          <?php
          $crearProducto = new ProductController();
          $crearProducto->ctrCrearProducto();
          ?>


      </form>

    </div> <!-- MODAL CONTENT -->

  </div> <!-- CLASS MODAL DIALOG -->

</div> <!--CIERRE MODAL AGREGAR USUARIO -->


<!--  MODAL EDITAR PRODUCTO -->

<div id="modalEditarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!-- MODAL HEADER -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar producto</h4>

        </div> <!-- FIN DE MODAL HEADER -->

        <div class="modal-body">
          <div class="box-body">

            <!-- EDITAR CATEGORIA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="editarCategoria" readonly required>

                  <option id="editarCategoria"></option>

                </select>

              </div>

            </div>

            <!-- EDITAR CODIGO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly
                  required>

              </div>

            </div>

            <!-- EDITAR CODIGO DE BARRAS-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                <input type="text" class="form-control input-lg" id="editarCodigoBarras" name="editarCodigoBarras"
                  required>

              </div>

            </div>

            <!-- EDITAR DE DESCRIPCION -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" "
                  required>

              </div>

            </div>

            <!-- INGRESO DE STOCK -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

              </div>

            </div>

            <!-- EDITAR PRECIO DE COMPRA -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra"
                    min="0" step="any" required>

                </div>

              </div>

              <!-- EDITAR PRECIO VENTA -->

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta"
                    min="0" step="any" readonly required>

                </div>

                <br>

                <!-- CHECKBOX PARA PORCENTAJE -->

                <div class="col-xs-6">

                  <div class="form-group">

                    <label>

                      <input type="checkbox" class="minimal porcentaje" checked>
                      Utilizar procentaje
                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6" style="padding:0">

                  <div class="input-group">

                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div> <!-- MODAL BODY -->
          </div> <!-- MODAL BOX -->
        
                </div>
          <!-- PIE DEL MODAL -->
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="
             modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>

          </div>

          <?php
          $editarProducto = new ProductController();
          $editarProducto->ctrEditarProducto();
          ?>
        
      </form>

    </div> <!-- MODAL CONTENT -->

  </div> <!-- CLASS MODAL DIALOG -->

</div> <!--CIERRE MODAL EDITAR PRODUCTO -->

<!-- BORRAR PRODUCTO -->
<?php
$borrarProducto = new ProductController();
$borrarProducto->ctrBorrarProducto();
?>