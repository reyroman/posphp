<?php

class DolarController{

  

      // MOSTRAR VALOR DOLAR 
      static public function ctrMostrarDolar($item, $valor){
        $tabla = "dolar";
        $respuesta = dolarModel::mdlMostrarDolar($tabla, $item, $valor);
        return $respuesta;
    }

	// EDITAR VALOR DOLAR
	
	static public function ctrEditarDolar(){

		if(isset($_POST["editarDolar"])){

			if(preg_match('/^[0-9.]+$/', $_POST["editarDolar"])){

				$tabla = "dolar";	
				
				$datos = array("id_usuario"=>$_POST["idUsuario"],
					           "valor_dolar"=>$_POST["editarDolar"],
							   "id"=>$_POST["idDolar"]);

			 $respuesta = DolarModel::mdlEditarDolar($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El valor del dolar se a modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "dolar";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El campor valor solo puede tener números y (.)!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "dolar";

							}
						})

			  	</script>';

			}

		}

	}

	
}