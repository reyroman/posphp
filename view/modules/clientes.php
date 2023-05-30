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
      Administrar clientes
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar clientes</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
          Agregar cliente
        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

          <thead>
            <tr>

              <th style="width:10px">#</th>
              <th>C.I</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Telefono</th>
              <th>Dirección</th>
              <th>Fecha de Nacimiento</th>
              <th>Total Compras</th>
              <th>Ultima compra</th>
              <th>Ingreso al sistema</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tbody>


            <?php

            $item = null;
            $valor = null;

            $clientes = ClienteController::ctrMostrarClientes($item, $valor);
            foreach ($clientes as $key => $value) {
              echo '<tr> 
    <td>' . ($key + 1) . '</td>
    <td class="text-uppercase">' . $value["ci"] . '</td>
    <td>' . $value["nombre"] . '</td>
    <td>' . $value["email"] . '</td>
    <td>' . $value["telefono"] . '</td>
    <td>' . $value["direccion"] . '</td>
    <td>' . $value["fecha_nacimiento"] . '</td>
    <td>' . $value["compras"] . '</td>
    <td>' . $value["ultima_compra"] . '</td>
    <td>' . $value["fecha"] . '</td>
    <td>
    <div class="btn-group">

    <button class="btn btn-warning btnEditarCliente" 
    idCliente="' . $value["id"] . '" data-toggle="modal" 
    data-target="#modalEditarCliente"><i class="fa fa-pencil"></i></button>';

    if($_SESSION["perfil"] == "Administrador"){

     echo' <button class="btn btn-danger btnEliminarCliente"
      idCliente="' . $value["id"] . '"><i class="fa fa-times"></i></button>';

    }
     

      echo' </div>
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

                <input type="number" min="0" class="form-control input-lg" name="nuevaCedula"
                id="nuevaCedula" placeholder="Ingresar cedula" required>

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


<!--  MODAL EDITAR CLIENTE -->

<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!-- MODAL HEADER -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar cliente</h4>

        </div>
        <!-- FIN DE MODAL HEADER -->

        <div class="modal-body">
          <div class="box-body">

            <!-- EDITAR CEDULA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="editarCedula"
                id="editarCedula"  required>

                <input type="hidden" id="idCliente" name="idCliente">

              </div>

            </div>

            <!-- EDITAR NOMBRE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre"
                  required>

              </div>

            </div>

            <!-- INGRESO DE EMAIL -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail">

              </div>

            </div>

            <!-- INGRESO DE TELEFONO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono"
                  data-inputmask="'mask':'(9999)-999 9999'" data-mask>

              </div>

            </div>

            <!-- INGRESO DE DIRECCION -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion">

              </div>

            </div>

            <!-- INGRESO DE FECHA DE NACIMIENTO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="editarFechaNacimiento"
                id="editarFechaNacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask>

              </div>

            </div>


          </div> <!-- MODAL BODY -->
        </div> <!-- MODAL BOX -->

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="
      modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar cliente</button>
        </div>

        <?php
        $editarCliente = new ClienteController();
        $editarCliente->ctrEditarCliente();
        ?>


      </form>

    </div> <!-- MODAL CONTENT -->

  </div> <!-- CLASS MODAL DIALOG -->

</div> <!--MODAL EDITAR CATEGORIA -->

<!-- BORRAR CATEGORIA -->

<?php

$borrarCliente = new ClienteController();
$borrarCliente->ctrBorrarCliente();

?>