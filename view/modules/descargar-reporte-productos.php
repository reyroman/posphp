<?php

require_once "../../controller/productos.controller.php";
require_once "../../model/productos.model.php";


$reporte = new ProductController();
$reporte -> ctrDescargarReporteProductos();