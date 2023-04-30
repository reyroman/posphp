<?php

require_once "../controller/productos.controller.php";
require_once "../model/productos.model.php";

require_once "../controller/categorias.controller.php";
require_once "../model/categorias.model.php";


class TablaProductos
{

	/*=============================================
	MOSTRAR LA TABLA DE PRODUCTOS
	=============================================*/

	public function mostrarTablaProductos()
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

			$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto'idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto'idProducto='" . $productos[$i]["id"] . "' codigo='".$productos[$i]["codigo"]."'><i class='fa fa-times'></i></button></div>";

			$datosJson .= '[
				 "' . ($i + 1) . '",
				 "' . $productos[$i]["codigo"] . '",
				 "' . $productos[$i]["codigo_barras"] . '",
				 "' . $productos[$i]["descripcion"] . '",
				 "' . $categorias["nombre"] . '",
				 "' . $stock . '",
				 "' . $productos[$i]["precio_compra"] . '",
				 "' . $productos[$i]["precio_venta"] . '",
				 "' . $productos[$i]["fecha"] . '",
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
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();