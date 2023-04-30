<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar usuarios
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar usuarios</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar usuario
        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla" width="100%">

          <thead>
            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tbody>

            <?php
            $item = null;
            $valor = null;

            $usuarios = UserController::ctrMostrarUsuarios($item, $valor);
            foreach ($usuarios as $key => $value) {
              echo '<tr> 
                <td>'.($key+1).'</td>
                <td>' . $value["nombre"] . '</td>
                <td>' . $value["usuario"] . '</td>
                <td>' . $value["perfil"] . '</td>';

              if ($value["estado"] != 0) {

                echo '<td> <button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'"
                  estadoUsuario= "0">Activo</button> </td>';
              } else {
                echo '<td> <button class="btn btn-danger btn-xs btnActivar"
                  idUsuario="'.$value["id"].'"
                  estadoUsuario= "1">Inactivo</button> </td>';
              }

              echo '<td>'.$value["ultimo_login"].'</td>
                <td>
                <div class="btn-group">

                <button class="btn btn-warning btnEditarUsuario"
                 idUsuario="'.$value["id"].'" data-toggle="modal" 
                 data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                 <button class="btn btn-danger btnEliminarUsuario" 
                 idUsuario="'.$value["id"].'"><i class="fa fa-times"></i></button>

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

<!--  MODAL AGREGAR USUARIO -->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!-- MODAL HEADER -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar usuario</h4>

        </div>
        <!-- FIN DE MODAL HEADER -->

        <div class="modal-body">
          <div class="box-body">
            <!-- INGRESO DE NOMBRE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre"
                  required>

              </div>

            </div>
            <!-- INGRESO DE USUARIO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoUsuario"
                  placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>
            <!-- INGRESO DE CONTRASEÑA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="nuevoPassword"
                  placeholder="Ingresar contraseña" required>

              </div>

            </div>
            <!-- INGRESO DE PERFIL -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Seleccionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

          </div> <!-- MODAL BODY -->
        </div> <!-- MODAL BOX -->

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="
        modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>

        <?php
        $crearUsuario = new UserController();
        $crearUsuario->ctrCrearUsuario();
        ?>


      </form>

    </div> <!-- MODAL CONTENT -->

  </div> <!-- CLASS MODAL DIALOG -->

</div> <!--CIERRE MODAL AGREGAR USUARIO -->


<!--  MODAL EDITAR USUARIO -->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!-- MODAL HEADER -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>

        </div>
        <!-- FIN DE MODAL HEADER -->

        <div class="modal-body">
          <div class="box-body">
            <!-- EDITAR NOMBRE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>
            <!-- EDITAR USUARIO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>
            <!-- EDITAR CONTRASEÑA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="editarPassword"
                  placeholder="Escriba una nueva contraseña">

                  <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>
            <!-- EDITAR PERFIL -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

          </div> <!-- MODAL BODY -->
        </div> <!-- MODAL BOX -->

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="
      modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar usuario</button>
        </div>

        <?php
          $editarUsuario = new UserController();
          $editarUsuario->ctrEditarUsuario();
        ?>


      </form>

    </div> <!-- MODAL CONTENT -->

  </div> <!-- CLASS MODAL DIALOG -->

</div> <!--CIERRE MODAL EDITAR USUARIO -->

<!-- BORRAR USUARIO -->
<?php
          $borrarUsuario = new UserController();
          $borrarUsuario->ctrBorrarUsuario();
?>