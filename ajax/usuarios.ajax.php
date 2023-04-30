<?php
require_once "../controller/usuarios.controller.php";
require_once "../model/usuarios.model.php";

class AjaxUsuarios{

    // EDITAR USUARIO

    public $idUsuario;
    public function ajaxEditarUsuario(){

        $item = "id";
        $valor = $this->idUsuario;

        $respuesta = UserController::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

    // ACTIVAR USUARIO

    public $activarUsuario;
    public $activarId;

    public function ajaxActivarUsuario()
    {

        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;

        $item2 = "id";
        $valor2 = $this->activarId;


        $respuesta = UserModel::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

    }

        // VALIDAR USUARIO REPETIDO

        public $validarUsuario;
        public function ajaxValidarUsuario(){

            $item = "usuario";
            $valor = $this->validarUsuario;

            $respuesta = UserController::ctrMostrarUsuarios($item, $valor);

            echo json_encode($respuesta);
        }

}

// EDITAR USUARIO

if (isset($_POST["idUsuario"])) {

    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();

}

// ACTIVAR USUARIO  

if(isset($_POST["activarUsuario"])) {

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();
}

// VALIDAR USUARIO REPETIDO

if(isset($_POST["validarUsuario"])){

    $valUsuario = new AjaxUsuarios();
    $valUsuario -> validarUsuario = $_POST["validarUsuario"];
    $valUsuario -> ajaxValidarUsuario();

}
