<?php
class UserController
{

    //Inicio de sesion
    static public function ctrIngresoUsuario()
    {

        if (isset($_POST["ingUsuario"])) {

            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
            ) {

                $encritar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST["ingUsuario"];

                $respuesta = UserModel::mdlMostrarUsuarios($tabla, $item, $valor);

                if (
                    $respuesta["usuario"] == $_POST["ingUsuario"] &&
                    $respuesta["password"] == $encritar) {
                   
                        if($respuesta["estado"] == 1){

                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    $_SESSION["usuario"] = $respuesta["usuario"];
                    $_SESSION["perfil"] = $respuesta["perfil"];

                    // REGISTRO DE FECHA DE LOGIN

                    date_default_timezone_set('America/Caracas');

                    $fecha = date('Y-m-d');
                    $hora = date('H:i:s');

                    $fechaActual = $fecha.' '.$hora;

                    $item1 = "ultimo_login";
                    $valor1 = $fechaActual;

                    $item2 = "id";
                    $valor2 = $respuesta["id"];

                    $ultimoLogin = UserModel::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
                    
                    if($ultimoLogin == "ok"){
                        
                    echo '<script>

                        window.location = "inicio";

                    </script>';

                    }      
                    }else{
                      echo '<br> <div class="alert alert-danger">El usuario no se encuentra activado</div>';
                    }

                } else {

                     echo '<br> <div class="alert alert-danger">Error en usuario o contraseña, vuelva a inetentarlo</div>';

                }
            }
        }
    }
    // CREAR USUARIO
    static public function ctrCrearUsuario()
    {

        if (isset($_POST["nuevoUsuario"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
            ) {

                $tabla = "usuarios";
                
                $encrytar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                
                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $encrytar,
                    "perfil" => $_POST["nuevoPerfil"]);

                $respuesta = UserModel::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    
                    echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';

                }

            } else {
                echo '<script>

                swal({

                    type: "error",
                    title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "usuarios";

                    }

                });
            

            </script>';
            }

        }
    }
    // MOSTRAR USUARIOS 
    static public function ctrMostrarUsuarios($item, $valor){
        $tabla = "usuarios";
        $respuesta = userModel::mdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }

    // EDITAR USUARIO

    static public function ctrEditarUsuario(){
        
        if (isset($_POST["editarUsuario"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {
            
                $tabla = "usuarios";

                if($_POST["editarPassword"] != ""){

                    if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
                   
                        $encrytar = crypt($_POST["editarPassword"],
                         '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    
                    }else{
    
                        echo'<script>

                        swal({
                              type: "error",
                              title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
        
                                window.location = "usuarios";
        
                                }
                            })
        
                      </script>';
    
                    }
                
               }else{

                $encrytar = $_POST["passwordActual"];
               }

               $datos = array(
                "nombre" => $_POST["editarNombre"],
                "usuario" => $_POST["editarUsuario"],
                "password" => $encrytar,
                "perfil" => $_POST["editarPerfil"]);

            $respuesta = UserModel::mdlEditarUsuario($tabla, $datos);
            
            if ($respuesta == "ok") {
                    
                echo'<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
            }
            }else{
                echo'<script>

                swal({
                      type: "error",
                      title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                        window.location = "usuarios";

                        }
                    })

              </script>';
            }     
          }
        }

        // ELIMINAR USUARIO

        static public function ctrBorrarUsuario(){

            if(isset($_GET["idUsuario"])){

                $tabla = "usuarios";
                $datos = $_GET["idUsuario"];
                
                $respuesta = UserModel::mdlBorrarUsuario($tabla, $datos);

                if($respuesta == "ok"){
                    echo'<script>

					swal({
						  type: "success",
						  title: "El usuario borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
                }
            }

        }
    }