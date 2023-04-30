<?php

class ClienteController{

    // CREAR CLIENTE
    static public function ctrCrearCliente()
    {

        if (isset($_POST["nuevoNombre"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevaCedula"]) 
			
            ){

                $tabla = "clientes";
                                
                $datos = array(
					"ci" => $_POST["nuevaCedula"],
                    "nombre" => $_POST["nuevoNombre"],
					"email" => $_POST["nuevoEmail"],
					"telefono" => $_POST["nuevoTelefono"],
					"direccion" => $_POST["nuevaDireccion"],
					"fecha_nacimiento" => $_POST["nuevaFechaNacimiento"]);
                    

                $respuesta = ClienteModel::mdlIngresarCliente($tabla, $datos);

                if ($respuesta == "ok") {
                    
                    echo '<script>

					swal({

						type: "success",
						title: "¡El cliente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

					</script>';

                }

            } else {
                echo '<script>

                swal({

                    type: "error",
                    title: "¡Los campos de cedula y nombre no pueden ir vacios o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "clientes";

                    }

                });
            

            </script>';
            }

        }
    }

      // MOSTRAR CLIENTES 
      static public function ctrMostrarClientes($item, $valor){
        $tabla = "clientes";
        $respuesta = clienteModel::mdlMostrarClientes($tabla, $item, $valor);
        return $respuesta;
    }

	// EDITAR CLIENTE
	
	static public function ctrEditarCliente(){

		if(isset($_POST["editarCedula"])){

			if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarCedula"]) 
			
            ){

				$tabla = "clientes";	
				
				$datos = array(
				"id" => $_POST["idCliente"],
				"ci" => $_POST["editarCedula"],
				"nombre" => $_POST["editarNombre"],
				"email" => $_POST["editarEmail"],
				"telefono" => $_POST["editarTelefono"],
				"direccion" => $_POST["editarDireccion"],
				"fecha_nacimiento" => $_POST["editarFechaNacimiento"]);

			 $respuesta = ClienteModel::mdlEditarCliente($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La cedula y el nombre no pueden ir vacios o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';

			}

		}

	}

	
	// BORRAR CATEGORIA
	

	static public function ctrBorrarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ClienteModel::mdlBorrarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "Registro borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
			}
		}
		
	}
}

