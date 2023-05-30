<?php
require_once "../../../controller/negocio.controller.php";
require_once "../../../model/negocio.model.php";

require_once "../../../controller/movimientos.controller.php";
require_once "../../../model/movimientos.model.php";

require_once "../../../controller/usuarios.controller.php";
require_once "../../../model/usuarios.model.php";

require_once "../../../controller/productos.controller.php";
require_once "../../../model/productos.model.php";

class imprimirMovimiento{

public $codigo;

public function traerImpresionMovimiento(){

// INFORMACION DEL NEGOCIO

$itemNegocio = "id";
$valorNegocio = 0;

$respuestaNegocio = NegocioController::ctrMostrarNegocio($itemNegocio, $valorNegocio);


//TRAEMOS LA INFORMACIÓN DEL MOVIMIENTO

$itemMovimiento = "codigo";
$valorMovimiento = $this->codigo;

$respuestaMovimiento = MovimientosController::ctrMostrarMovimientos($itemMovimiento, $valorMovimiento);

$fecha = substr($respuestaMovimiento["fecha"],0,-8);
$tipo = substr($respuestaMovimiento["tipo_movimiento"], 0);
$descripcion = substr($respuestaMovimiento["descripcion"], 0);
$productos = json_decode($respuestaMovimiento["productos"], true);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemUsuario = "id";
$valorUsuario = $respuestaMovimiento["id_usuario"];

$respuestaUsuario = UserController::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque2.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Empresa: $respuestaNegocio[nombre]
					<br>
					Rif: $respuestaNegocio[rif]
					<br>
					Dirección: $respuestaNegocio[direccion]

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: $respuestaNegocio[telefono]
					
					<br>
					$respuestaNegocio[email]

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>MOVIMIENTO N.<br>$valorMovimiento</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Usuario: $respuestaUsuario[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Descripción: $descripcion

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Movimiento: $tipo

			</td>

		</tr>


		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">Codigo</td>
		<td style="border: 1px solid #666; background-color:white; width:250px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center">Cantidad</td>
	

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ProductController::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$codigo = substr($respuestaProducto["codigo_barras"],0);


$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:150px; text-align:center">
			$codigo
			
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:250px; text-align:center">
			$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:140px; text-align:center">
			$item[cantidad]
			</td>

		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 
ob_end_clean();
$pdf->Output('movimiento.pdf', 'D');

}

}

$movimiento = new imprimirMovimiento();
$movimiento -> codigo = $_GET["codigo"];
$movimiento -> traerImpresionMovimiento();

?>