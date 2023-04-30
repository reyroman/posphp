<?php

require_once "../controller/clientes.controller.php";
require_once "../model/clientes.model.php";

class AjaxClientes{

	
	// EDITAR CLIENTES     
	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ClienteController::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}

      // VALIDAR CLIENTE REPETIDO

      public $validarCliente;
      public function ajaxValidarCliente(){

          $item = "ci";
          $valor = $this->validarCliente;

          $respuesta = ClienteController::ctrMostrarClientes($item, $valor);

          echo json_encode($respuesta);
      }
}


// EDITAR CLIENTE

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();
}

// VALIDAR CLIENTE REPETIDO

if(isset($_POST["validarCliente"])){

    $valCliente = new AjaxClientes();
    $valCliente -> validarCliente = $_POST["validarCliente"];
    $valCliente -> ajaxValidarCliente();

}
