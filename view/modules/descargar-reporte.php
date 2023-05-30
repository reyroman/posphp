<?php

require_once "../../controller/ventas.controller.php";
require_once "../../model/ventas.model.php";
require_once "../../controller/clientes.controller.php";
require_once "../../model/clientes.model.php";
require_once "../../controller/usuarios.controller.php";
require_once "../../model/usuarios.model.php";

$reporte = new VentasController();
$reporte -> ctrDescargarReporte();