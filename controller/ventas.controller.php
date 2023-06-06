<?php
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


class VentasController{

    // MOSTRAR VENTAS

    static public function ctrMostrarVentas($item, $valor){
        $tabla = "ventas";
        $respuesta = VentasModel::mdlMostrarVentas($tabla, $item, $valor);
        return $respuesta;
    }


    // CREAR VENTA

    static public function ctrCrearVenta(){

        if(isset($_POST["nuevaVenta"])){

            if($_POST["listaProductos"] == ""){

                echo'<script>

            swal({
                  type: "error",
                  title: "La venta no se ejecuta si no hay productos",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "ventas";

                            }
                        })

            </script>';

            return;
        }

           // ACTUALIZAR CLIENTE, STOCK Y VENTAS DEL PRODUCTO

            $listaProductos = json_decode($_POST["listaProductos"], true);

            $totalProductosComprados = array();

            foreach ($listaProductos as $key => $value) {

                array_push($totalProductosComprados, $value["cantidad"]);
                
                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ProductModel::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a = "ventas";
                $valor1a = $value["cantidad"] + $traerProducto["ventas"];

                $nuevasVentas = ProductModel::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["stock"];

                $nuevoStock = ProductModel::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);                

            }

                $tablaClientes = "clientes";

                $item = "id";
                $valor = $_POST["seleccionarCliente"];

                $traerCliente = ClienteModel::mdlMostrarClientes($tablaClientes, $item, $valor);

                $item1a = "compras";
                $valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

                $comprasCliente = ClienteModel::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

                $item1b = "ultima_compra";
                
                date_default_timezone_set("America/Caracas");

                $fecha = date('Y-m-d');
                $hora = date('H:i:s');

                $valor1b = $fecha.' '.$hora;

                $comprasCliente = ClienteModel::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

                // GUARDAR LA COMPRA

                $tabla = "ventas";

                $datos = array(
                    "codigo" => $_POST["nuevaVenta"],
                    "tipo_venta" => $_POST["tipoVenta"],
                    "id_cliente" => $_POST["seleccionarCliente"],
                    "id_vendedor" => $_POST["idVendedor"],
                    "productos" => $_POST["listaProductos"],
                    "impuesto" => $_POST["nuevoPrecioImpuesto"],
                    "valor_dolar" => $_POST["nuevoValorDolar"],
                    "neto" => $_POST["nuevoPrecioNeto"],
                    "total" => $_POST["totalVenta"],
                    "total_bolivares" => $_POST["totalVentaBolivares"],
                    "metodo_pago" => $_POST["listaMetodoPago"]);

                    $respuesta = VentasModel::mdlIngresarVenta($tabla, $datos);

                      if ($respuesta == "ok") {

                        // IMPRIMIR TICKET DE VENTA 

                        // $impresora = "epson20";

                        // $conector = new WindowsPrintConnector($impresora);

                        // $printer = new Printer($conector);

                        // $printer -> setJustification(Printer::JUSTIFY_CENTER);

                        // $printer -> text(date("Y-m-d H:i:s")."\n");//Fecha de la factura

                        // $printer -> feed(1); //Alimentamos el papel 1 vez*/

                        // $printer -> text("ServiPOS"."\n");//Nombre de la empresa

                        // $printer -> text("RIF: 17.437.120-9"."\n");//Nit de la empresa

                        // $printer -> text("Dirección: Calle 1 25-88"."\n");//Dirección de la empresa

                        // $printer -> text("Teléfono: 0412-7304919"."\n");//Teléfono de la empresa

                        // $printer -> text("FACTURA N.".$_POST["nuevaVenta"]."\n");//Número de factura

                        // $printer -> feed(1); //Alimentamos el papel 1 vez*/

                        // $printer -> text("Cliente: ".$traerCliente["nombre"]."\n");//Nombre del cliente

                        // $tablaVendedor = "usuarios";
                        // $item = "id";
                        // $valor = $_POST["idVendedor"];

                        // $traerVendedor = UserModel::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

                        // $printer -> text("Vendedor: ".$traerVendedor["nombre"]."\n");//Nombre del vendedor

                        // $printer -> feed(1); //Alimentamos el papel 1 vez*/

                        // foreach ($listaProductos as $key => $value) {

                        //     $printer->setJustification(Printer::JUSTIFY_LEFT);

                        //     $printer->text($value["descripcion"]."\n");//Nombre del producto

                        //     $printer->setJustification(Printer::JUSTIFY_RIGHT);

                        //     $printer->text("$ ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = $ ".number_format($value["total"],2)."\n");

                        // }

                        // $printer -> feed(1); //Alimentamos el papel 1 vez*/			
                        
                        // $printer->text("NETO: $ ".number_format($_POST["nuevoPrecioNeto"],2)."\n"); //ahora va el neto

                        // $printer->text("IMPUESTO: $ ".number_format($_POST["nuevoPrecioImpuesto"],2)."\n"); //ahora va el impuesto

                        // $printer->text("--------\n");

                        // $printer->text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n"); //ahora va el total

                        // $printer -> feed(1); //Alimentamos el papel 1 vez*/	

                        // $printer->text("Muchas gracias por su compra"); //Podemos poner también un pie de página

                        // $printer -> feed(3); //Alimentamos el papel 3 veces*/

                        // $printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

                        // $printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder

                        // $printer -> close();
                    
                        echo '<script>
    
                        swal({
    
                            type: "success",
                            title: "¡La venta ha sido guardada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                            
                                window.location = "ventas";
    
                            }
    
                        });
                    
    
                        </script>';
    
                    }

                    }

    }


    // EDITAR VENTA

    static public function ctrEditarVenta(){

        if(isset($_POST["editarVenta"])){

            // FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES

            $tabla = "ventas";

                $item = "codigo";
                $valor =$_POST["editarVenta"];

                $traerVenta = VentasModel::mdlMostrarVentas($tabla, $item, $valor);

                // REVISAR SI VIENEN PRODUCTOS EDITADOS

                if($_POST["listaProductos"] == ""){

                    $listaProductos = $traerVenta["productos"];
                    $cambioProducto = false;

                }else{

                    $listaProductos = $_POST["listaProductos"];
                    $cambioProducto = true;

                }

                if($cambioProducto){

                $productos = json_decode($traerVenta["productos"], true);

                $totalProductosComprados = array();

               foreach ($productos as $key => $value) {

                array_push($totalProductosComprados, $value["cantidad"]);

                $tablaProductos = "productos";

                    $item = "id";
                    $valor = $value["id"];
                    $orden = "id";
    
                    $traerProducto = ProductModel::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                    $item1a = "ventas";
                    $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                    $nuevasVentas = ProductModel::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                    $item1b = "stock";
                    $valor1b = $value["cantidad"] + $traerProducto["stock"];

                    $nuevoStock = ProductModel::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor); 
                    
               }

                $tablaClientes = "clientes";

                $itemCliente = "id";
                $valorCliente = $_POST["seleccionarCliente"];

                $traerCliente = ClienteModel::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

                $item1a = "compras";
                $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

                $comprasCliente = ClienteModel::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

            //ACTUALIZAR CLIENTE, STOCK Y VENTAS DEL PRODUCTO

            $listaProductos_2 = json_decode($listaProductos, true);

            $totalProductosComprados_2 = array();

            foreach ($listaProductos_2 as $key => $value) {

                array_push($totalProductosComprados_2, $value["cantidad"]);
                
                $tablaProductos_2 = "productos";

                $item_2 = "id";
                $valor_2 = $value["id"];
                $orden = "id";

                $traerProducto_2 = ProductModel::mdlMostrarProductos($tablaProductos_2, 
                $item_2, $valor_2, $orden);

                $item1a_2 = "ventas";
                $valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

                $nuevasVentas_2 = ProductModel::mdlActualizarProducto($tablaProductos_2,
                 $item1a_2, $valor1a_2, $valor_2);

                $item1b_2 = "stock";
                $valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

                $nuevoStock_2 = ProductModel::mdlActualizarProducto($tablaProductos_2, 
                $item1b_2, $valor1b_2, $valor_2);                

            }

                $tablaClientes_2 = "clientes";

                $item_2 = "id";
                $valor_2b = $_POST["seleccionarCliente"];

                $traerCliente_2 = ClienteModel::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2b);

                $item1a_2 = "compras";
                $valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

                $comprasCliente_2 = ClienteModel::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2b);

                $item1b_2 = "ultima_compra";
                
                date_default_timezone_set("America/Caracas");

                $fecha = date('Y-m-d');
                $hora = date('H:i:s');

                $valor1b_2 = $fecha.' '.$hora;

                $fechaCliente_2 = ClienteModel::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2b);

                }

                // GUARDAR CAMBIOS DE LA COMPRA

                $datos = array(
                    "codigo" => $_POST["editarVenta"],
                    "id_cliente" => $_POST["seleccionarCliente"],
                    "id_vendedor" => $_POST["idVendedor"],
                    "productos" => $listaProductos,
                    "impuesto" => $_POST["nuevoPrecioImpuesto"],
                    "valor_dolar" => $_POST["nuevoValorDolar"],
                    "neto" => $_POST["nuevoPrecioNeto"],
                    "total" => $_POST["totalVenta"],
                    "total_bolivares" => $_POST["totalVentaBolivares"],
                    "metodo_pago" => $_POST["listaMetodoPago"]);

                    $respuesta = VentasModel::mdlEditarVenta($tabla, $datos);

                
                    if ($respuesta == "ok") {
                    
                        echo '<script>
    
                        swal({
    
                            type: "success",
                            title: "¡La venta se ha editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                            
                                window.location = "ventas";
    
                            }
    
                        });
                    
    
                        </script>';
    
                    }

                    }

    }

    // ELIMINAR VENTA

    static public function ctreliminarVenta(){

        if(isset($_GET["idVenta"])){

            $tabla = "ventas";

            $item = "id";
            $valor = $_GET["idVenta"];

            $traerVenta = VentasModel::mdlMostrarVentas($tabla, $item, $valor);

            //ACTUALIZAR FECHA, ULTIMA COMPRA
            
            $itemVentas = null;
            $valorVentas = null;

            $traerVentas = VentasModel::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

            $guardarFechas = array();
            $tablaClientes = "clientes";

             foreach ($traerVentas as $key => $value) {
                
                if($value["id_cliente"] == $traerVenta["id_cliente"]){
                    
                    array_push($guardarFechas, $value["fecha"]);
                    

                }

            }
            if(count($guardarFechas) > 1){

                if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

                $item = "ultima_compra";
                $valor = $guardarFechas[count($guardarFechas)-2];
                $valorIdCliente = $traerVenta["id_cliente"];

                $comprasCliente = ClienteModel::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

                }else{

                $item = "ultima_compra";
                $valor = $guardarFechas[count($guardarFechas)-1];
                $valorIdCliente = $traerVenta["id_cliente"];

                $comprasCliente = ClienteModel::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

                }


            }else{

                $item = "ultima_compra";
                $valor = "0000-00-00 00:00:00";
                $valorIdCliente = $traerVenta["id_cliente"];

                $comprasCliente = ClienteModel::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

            }

            //FORMATEAR TABLA DE PRODUCTOS

            $productos = json_decode($traerVenta["productos"], true);

            $totalProductosComprados = array();

           foreach ($productos as $key => $value) {

            array_push($totalProductosComprados, $value["cantidad"]);

            $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ProductModel::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a = "ventas";
                $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                $nuevasVentas = ProductModel::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["cantidad"] + $traerProducto["stock"];

                $nuevoStock = ProductModel::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor); 
                
           }

            $tablaClientes = "clientes";

            $itemCliente = "id";
            $valorCliente = $traerVenta["id_cliente"];

            $traerCliente = ClienteModel::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

            $item1a = "compras";
            $valor1a = ($traerCliente["compras"] - array_sum($totalProductosComprados));

            $comprasCliente = ClienteModel::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

            // ELIMINAR VENTA

            $respuesta = VentasModel::mdlEliminarVenta($tabla, $_GET["idVenta"]);

            if($respuesta == "ok"){
                echo'<script>

                swal({
                      type: "success",
                      title: "La venta ha sido borrada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "ventas";

                                }
                            })

                </script>';
            }
        }

    }

   

// RANGO FECHAS

static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

    $tabla = "ventas";

    $respuesta = VentasModel::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);
    
    return $respuesta;
}


// DESCARGAR EXCEL
	
static public function ctrDescargarReporte(){

    if(isset($_GET["reporte"])){

        $tabla = "ventas";

        if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

            $ventas = VentasModel::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

        }else{

            $item = null;
            $valor = null;

            $ventas = VentasModel::mdlMostrarVentas($tabla, $item, $valor);

        }
    
        // CREAMOS EL ARCHIVO DE EXCEL
        
        $Name = 'reporte'.'.xls';

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
                <td style='font-weight:bold; border:1px solid #eee;'>TIPO VENTA</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
                <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
                <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
                <td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
                <td style='font-weight:bold; border:1px solid #eee;'>VALOR DEL DOLAR</td>
                <td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
                <td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>	
                <td style='font-weight:bold; border:1px solid #eee;'>TOTAL BOLIVARES</td>		
                <td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
                <td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
                </tr>");

                $sumtotal = null;
                $sumtotalBs = null;

        foreach ($ventas as $row => $item){

            $cliente = ClienteController::ctrMostrarClientes("id", $item["id_cliente"]);
            $vendedor = UserController::ctrMostrarUsuarios("id", $item["id_vendedor"]);

         echo utf8_decode("<tr>
                     <td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
                     <td style='border:1px solid #eee;'>".$item["tipo_venta"]."</td>
                     <td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
                     <td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
                     <td style='border:1px solid #eee;'>");

             $productos =  json_decode($item["productos"], true);

             foreach ($productos as $key => $valueProductos) {
                     
                     echo utf8_decode($valueProductos["cantidad"]."<br>");
                 }

             echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

             foreach ($productos as $key => $valueProductos) {
                     
                 echo utf8_decode($valueProductos["descripcion"]."<br>");
             
             }

             echo utf8_decode("</td>
                <td style='border:1px solid #eee;'>".number_format($item["impuesto"],2)."</td>
                <td style='border:1px solid #eee;'>".number_format($item["valor_dolar"],2)."</td>
                <td style='border:1px solid #eee;'>".number_format($item["neto"],2)."</td>	
                <td style='border:1px solid #eee;'>".number_format($item["total"],2)."</td>
                <td style='border:1px solid #eee;'>".number_format($item["total_bolivares"],2)."</td>
                <td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
                <td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
                 </tr>");
                    
        $sumtotal += floatval($item["total"]);
        $sumtotalBs += floatval($item["total_bolivares"]);

        }
        

    echo("
    <tr></tr>
    <tr>
        <td colspan='12'  style='font-weight:bold; text-align:right;'>Total  = $".$sumtotal."</td>
    </tr>
    <tr>
        <td colspan='12'  style='font-weight:bold; text-align:right;'>Total  = ".$sumtotalBs."Bs</td>
    </tr>");
    echo "</table>";

    }

}

 // SUMA TOTAL VENTAS BOLIVARES
	
 static public function ctrSumaTotalVentasBs(){

    $tabla = "ventas";

    $respuesta = VentasModel::mdlSumaTotalVentasBs($tabla);

    return $respuesta;

}

 // SUMA TOTAL VENTAS DOLARES
	
 static public function ctrSumaTotalVentasDolares(){

    $tabla = "ventas";

    $respuesta = VentasModel::mdlSumaTotalVentasDolares($tabla);

    return $respuesta;

}

}