<?php

require_once "../controller/dolar.controller.php";
require_once "../model/dolar.model.php";

class AjaxDolar{

	/*=============================================
	EDITAR VALOR DOLAR
	=============================================*/	

	public $idDolar;




	public function ajaxEditarDolar(){

		$item = "id";
		$valor = $this->idDolar;

		$respuesta = DolarController::ctrMostrarDolar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR VALOR DOLAR
=============================================*/	
if(isset($_POST["idDolar"])){

	$dolar = new AjaxDolar();
	$dolar -> idDolar = $_POST["idDolar"];
	$dolar -> ajaxEditarDolar();
}



