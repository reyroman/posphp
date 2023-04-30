<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar categorías
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar categorías</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar categoría
        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

          <thead>
            <tr>

              <th style="width:10px">#</th>
              <th>Categoría</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tbody>

                <td>1</td>
                <td>EQUIPOS ELECTROMECANICOS</td>
                
                <td>
                <button class="btn btn-warning btnEditarCategoria"
                 idCategoria="" data-toggle="modal" 
                 data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                 <button class="btn btn-danger btnEliminarCategoria" 
                 idCategoria=""><i class="fa fa-times"></i></button>
                </td>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--  Modal Agregar Categoria -->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!-- MODAL HEADER -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar categoría</h4>

        </div>
        <!-- FIN DE MODAL HEADER -->

        <div class="modal-body">
          <div class="box-body">
            <!-- INGRESO DE CATEGORIA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría"
                  required>

              </div>

            </div>
            

          </div> <!-- modal body -->
        </div> <!-- modal box -->
        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="
        modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar categoría</button>
        </div>

        <?php
        // $crearCategoria = new UserCategoria();
        // $crearCategoria->ctrCrearCategoria();
        ?>


      </form>

    </div> <!-- modal content -->

  </div> <!-- class modal dialog -->

</div> <!--cierre de la ventana modal agregar usuario -->


