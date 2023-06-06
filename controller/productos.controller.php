
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
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])&&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioMayor"])
            ) {

                $tabla = "productos";
                              
                $datos = array(
                    "id_categoria" => $_POST["nuevaCategoria"],
                    "codigo" => $_POST["nuevoCodigo"],
                    "codigo_barras" => $_POST["nuevoCodigoBarras"],
                    "descripcion" => $_POST["nuevaDescripcion"],
                    "stock" => $_POST["nuevoStock"],
                    "precio_compra" => $_POST["nuevoPrecioCompra"],
                    "precio_venta" => $_POST["nuevoPrecioVenta"],
                    "precio_mayor" => $_POST["nuevoPrecioMayor"]);

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
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])&& 
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioMayor"]))
                {
            
                $tabla = "productos";

               $datos = array(
                "id_categoria" => $_POST["editarCategoria"],
                "codigo" => $_POST["editarCodigo"],
                "codigo_barras" => $_POST["editarCodigoBarras"],
                "descripcion" => $_POST["editarDescripcion"],
                "stock" => $_POST["editarStock"],
                "precio_compra" => $_POST["editarPrecioCompra"],
                "precio_venta" => $_POST["editarPrecioVenta"],
                "precio_mayor" => $_POST["editarPrecioMayor"]);

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


    // DESCARGAR EXCEL
	
static public function ctrDescargarReporteProductos(){

    if(isset($_GET["reporte"])){

        $tabla = "productos";

            $item = null;
            $valor = null;

            $productos = ProductModel::mdlMostrarProductos($tabla, $item, $valor, "id");

        
    
        // CREAMOS EL ARCHIVO DE EXCEL
        
        $Name = $_GET["reporte"].'.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate"); 
        header('Content-Description: File Transfer');
        header('Last-Modified: '.date('D, d M Y H:i:s'));
        header("Pragma: public"); 
        header('Content-Disposition:; filename="'.$Name.'"');
        header("Content-Transfer-Encoding: binary");

        echo utf8_decode("<table border='0'> 

                <tr> 
                <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
                <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO DE BARRAS</td>
                <td style='font-weight:bold; border:1px solid #eee;'>DESCRIPCION</td>
                <td style='font-weight:bold; border:1px solid #eee;'>STOCK</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PRECIO DE COMPRA</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PRECIO DE VENTA</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PRECIO AL MAYOR</td>		
                <td style='font-weight:bold; border:1px solid #eee;'>VENTAS</td>	
                <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE CREACION</td>		
                </tr>");

        foreach ($productos as $row => $item){

      

             echo utf8_decode("</td>
                <td style='border:1px solid #eee;'>".$item["codigo"]."</td>
                <td style='border:1px solid #eee;'>".$item["codigo_barras"]."</td>
                <td style='border:1px solid #eee;'>".$item["descripcion"]."</td>
                <td style='border:1px solid #eee;'>".$item["stock"]."</td>
                <td style='border:1px solid #eee;'>".number_format($item["precio_compra"],2)."</td>
                <td style='border:1px solid #eee;'>".number_format($item["precio_venta"],2)."</td>	
                <td style='border:1px solid #eee;'>".number_format($item["precio_mayor"],2)."</td>
                <td style='border:1px solid #eee;'>".$item["ventas"]."</td>
                <td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
                 </tr>");


        }


        echo "</table>";

    }

}

    }

    