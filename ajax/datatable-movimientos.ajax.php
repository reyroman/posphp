<?php

require_once "../controller/productos.controller.php";
require_once "../model/productos.model.php";

require_once "../controller/categorias.controller.php";
require_once "../model/categorias.model.php";


class TablaProductosMovimientos
{

	/*=============================================
	MOSTRAR LA TABLA DE PRODUCTOS
	=============================================*/

	public function mostrarTablaProductosMovimientos()
	{

		$item = null;
		$valor = null;
		$orden = "id";

		$productos = ProductController::ctrMostrarProductos($item, $valor, $orden);

		$datosJson = '{
		 "data": [';

		for ($i = 0; $i < count($productos); $i++) {



			/*=============================================
			TRAEMOS LA CATEGORÍA
			=============================================*/

			$item = "id";
			$valor = $productos[$i]["id_categoria"];

			$categorias = CategoriaController::ctrMostrarCategorias($item, $valor);

			/*=============================================
			STOCK
			=============================================*/

			if ($productos[$i]["stock"] <= 10) {

				$stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";

			} else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {

				$stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";

			} else {

				$stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";

			}

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/

			$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton2' idProducto='" .$productos[$i]["id"] . "'>Agregar</button></div>";

			$datosJson .= '[
				 "' . ($i + 1) . '",
				 "' . $productos[$i]["codigo"] . '",
				 "' . $productos[$i]["codigo_barras"] . '",
				 "' . $productos[$i]["descripcion"] . '",
				 "' . $categorias["nombre"] . '",
				 "' . $stock . '",
				 "' . $botones . '"
			   ],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= '] 

		}';

		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductosMovimientos = new TablaProductosMovimientos();
$activarProductosMovimientos->mostrarTablaProductosMovimientos();