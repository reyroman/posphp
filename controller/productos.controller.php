
<?php
class ProductController
{

    // MOSTRAR PRODUCTOS 
    static public function ctrMostrarProductos($item, $valor, $orden){
        
        $tabla = "productos";

        $respuesta = ProductModel::mdlMostrarProductos($tabla, $item, $valor, $orden);
        
        return $respuesta;

    }

    // CREAR PRODUCTO
    static public function ctrCrearProducto()
    {

        if (isset($_POST["nuevaDescripcion"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoCodigoBarras"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"])&&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])
            ) {

                $tabla = "productos";
                              
                $datos = array(
                    "id_categoria" => $_POST["nuevaCategoria"],
                    "codigo" => $_POST["nuevoCodigo"],
                    "codigo_barras" => $_POST["nuevoCodigoBarras"],
                    "descripcion" => $_POST["nuevaDescripcion"],
                    "stock" => $_POST["nuevoStock"],
                    "precio_compra" => $_POST["nuevoPrecioCompra"],
                    "precio_venta" => $_POST["nuevoPrecioVenta"]);

                $respuesta = ProductModel::mdlIngresarProducto($tabla, $datos);

                if ($respuesta == "ok") {
                    
                    echo '<script>

					swal({

						type: "success",
						title: "¡El producto ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "productos";

						}

					});
				

					</script>';

                }

            } else {
                echo '<script>

                swal({

                    type: "error",
                    title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "productos";

                    }

                });
            

            </script>';
            }

        }
    }
    

    // EDITAR PRODUCTO

    static public function ctrEditarProducto(){
        
        if (isset($_POST["editarDescripcion"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarCodigoBarras"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"])&&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])) {
            
                $tabla = "productos";

               $datos = array(
                "id_categoria" => $_POST["editarCategoria"],
                "codigo" => $_POST["editarCodigo"],
                "codigo_barras" => $_POST["editarCodigoBarras"],
                "descripcion" => $_POST["editarDescripcion"],
                "stock" => $_POST["editarStock"],
                "precio_compra" => $_POST["editarPrecioCompra"],
                "precio_venta" => $_POST["editarPrecioVenta"]);

            $respuesta = ProductModel::mdlEditarProducto($tabla, $datos);
            
            if ($respuesta == "ok") {
                    
                echo'<script>

					swal({
						  type: "success",
						  title: "El producto ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "productos";

									}
								})

					</script>';
            }
            }else{
                echo'<script>

                swal({
                      type: "error",
                      title: "¡Los campos no pueden ir vacios!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                        window.location = "productos";

                        }
                    })

              </script>';
            }     
          }
        }

        // ELIMINAR PRODUCTO

        static public function ctrBorrarProducto(){

            if(isset($_GET["idProducto"])){

                $tabla = "productos";
                $datos = $_GET["idProducto"];
                
                $respuesta = ProductModel::mdlBorrarProducto($tabla, $datos);

                if($respuesta == "ok"){
                    echo'<script>

					swal({
						  type: "success",
						  title: "Producto borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "productos";

									}
								})

					</script>';
                }
            }

        }

        
	// MOSTRAR SUMA VENTAS
	

	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ProductModel::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}

    }