<?php 

// MOSTRAR ERRORES

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', "C:/xampp/htdocs/pos/php_error_log");


require_once "controller/template.controller.php";
require_once "controller/categorias.controller.php";
require_once "controller/clientes.controller.php";
require_once "controller/productos.controller.php";
require_once "controller/usuarios.controller.php";
require_once "controller/ventas.controller.php";
require_once "controller/movimientos.controller.php";
require_once "controller/dolar.controller.php";

require_once "model/categorias.model.php";
require_once "model/clientes.model.php";
require_once "model/productos.model.php";
require_once "model/usuarios.model.php";
require_once "model/ventas.model.php";
require_once "model/movimientos.model.php";
require_once "model/dolar.model.php";
require_once "extensions/vendor/autoload.php";

$template = new TemplateController();
$template -> ctrTemplate();


