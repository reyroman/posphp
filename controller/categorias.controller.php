<?php

class CategoriaController{

    // CREAR CATEGORIA
    static public function ctrCrearCategoria()
    {

        if (isset($_POST["nuevaCategoria"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"]) 
            ) {

                $tabla = "categorias";
                                
                $datos = array(
                    "nombre" => $_POST["nuevaCategoria"]);
                    

                $respuesta = CategoriaModel::mdlIngresarCategoria($tabla, $datos);

                if ($respuesta == "ok") {
                    
                    echo '<script>

					swal({

						type: "success",
						title: "¡La categoria ha sido guardada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

					</script>';

                }

            } else {
                echo '<script>

                swal({

                    type: "error",
                    title: "¡La categoria no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "categorias";

                    }

                });
            

            </script>';
            }

        }
    }

      // MOSTRAR CATEGORIA 
      static public function ctrMostrarCategorias($item, $valor){
        $tabla = "categorias";
        $respuesta = categoriaModel::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }

	// EDITAR CATEGORIA
	
	static public function ctrEditarCategoria(){

		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

				$tabla = "categorias";	
				
				$datos = array("nombre"=>$_POST["editarCategoria"],
							   "id"=>$_POST["idCategoria"]);

			 $respuesta = CategoriaModel::mdlEditarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	
	// BORRAR CATEGORIA
	

	static public function ctrBorrarCategoria(){

		if(isset($_GET["idCategoria"])){

			$tabla ="categorias";
			$datos = $_GET["idCategoria"];

			$respuesta = CategoriaModel::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
		}
		
	}
}