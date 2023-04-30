<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar valor dolar
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar dolar</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">
      <!-- <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
          Agregar categoría
        </button>

      </div> -->

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

          <thead>
            <tr>

              <th style="width:10px">#</th>
              <th>Valor</th>
              <th>Fecha</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tbody>

            <?php
            $item = null;
            $valor = null;

            $dolar = DolarController::ctrMostrarDolar($item, $valor);
            foreach ($dolar as $key => $value) {
              echo '<tr> 
                <td>' . ($key + 1) . '</td>
                <td class="text-uppercase">' . $value["valor_dolar"] . '</td>
                <td class="text-uppercase">' . $value["fecha"] . '</td>
            
                <td>
                <div class="btn-group">

                <button class="btn btn-warning btnEditarDolar" 
                idDolar="' . $value["id"] . '" data-toggle="modal" 
                data-target="#modalEditarDolar"><i class="fa fa-pencil"></i></button>

                </div>
                </td>
                </tr>';

            }
            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>


<!--  MODAL EDITAR VALOR DOLAR -->

<div id="modalEditarDolar" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!-- MODAL HEADER -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar dolar</h4>

        </div>
        <!-- FIN DE MODAL HEADER -->

        <div class="modal-body">
          <div class="box-body">

            <!-- EDITAR VALOR DOLAR -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                <input type="text" class="form-control input-lg" id="editarDolar" name="editarDolar" required>

                <input type="hidden" name="idDolar" id="idDolar" required>

              </div>

            </div>


          </div> <!-- MODAL BODY -->
        </div> <!-- MODAL BOX -->

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="
      modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar valor</button>
        </div>

        <?php
        $editarDolar = new DolarController();
        $editarDolar->ctrEditarDolar();
        ?>


      </form>

    </div> <!-- MODAL CONTENT -->

  </div> <!-- CLASS MODAL DIALOG -->

</div> <!--MODAL EDITAR DOLAR -->

