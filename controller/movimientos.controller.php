<?php

class MovimientosController{

    // MOSTRAR MOVIMIENTOS

    static public function ctrMostrarMovimientos($item, $valor){
        $tabla = "movimientos_inventario";
        $respuesta = MovimientosModel::mdlMostrarMovimientos($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrEliminarEntrada(){


        $tabla = "movimientos_inventario";

        $item = "id";
        $valor = $_GET["idMovimiento"];

        $traerMovimientoEntrada = MovimientosModel::mdlMostrarMovimientos($tabla, $item, $valor);

        //FORMATEAR TABLA DE PRODUCTOS

        $productos = json_decode($traerMovimientoEntrada["productos"], true);

        foreach ($productos as $key => $value) {

        $tablaProductos = "productos";

            $item = "id";
            $valor = $value["id"];
            $orden = "id";

            $traerProducto = ProductModel::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

            $item1b = "stock";
            $valor1b = $traerProducto["stock"] - $value["cantidad"];

            $nuevoStock = ProductModel::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor); 
            
       }

       // ELIMINAR ENTRADA

        $respuesta = VentasModel::mdlEliminarVenta($tabla, $_GET["idMovimiento"]);

        if($respuesta == "ok"){
            echo'<script>

            swal({
                  type: "success",
                  title: "La entrada ha sido borrada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "movimientos";

                            }
                        })

            </script>';
        }
}

static public function ctrEliminarSalida(){


    $tabla = "movimientos_inventario";

    $item = "id";
    $valor = $_GET["idMovimiento"];

    $traerMovimientoEntrada = MovimientosModel::mdlMostrarMovimientos($tabla, $item, $valor);

    //FORMATEAR TABLA DE PRODUCTOS

    $productos = json_decode($traerMovimientoEntrada["productos"], true);

    foreach ($productos as $key => $value) {

    $tablaProductos = "productos";

        $item = "id";
        $valor = $value["id"];
        $orden = "id";

        $traerProducto = ProductModel::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

        $item1b = "stock";
        $valor1b = $traerProducto["stock"] + $value["cantidad"];

        $nuevoStock = ProductModel::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor); 
        
   }

    // ELIMINAR SALIDA

    $respuesta = VentasModel::mdlEliminarVenta($tabla, $_GET["idMovimiento"]);

    if($respuesta == "ok"){
        echo'<script>

        swal({
              type: "success",
              title: "La salida de mercancia ha sido borrada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                        if (result.value) {

                        window.location = "movimientos";

                        }
                    })

        </script>';
    }
}


    // CREAR ENTRADA

    static public function ctrCrearEntrada(){

        if(isset($_POST["nuevaEntrada"])){

            if($_POST["listaProductos2"] == ""){

                echo'<script>

            swal({
                  type: "error",
                  title: "La entrada no se ejecuta si no hay productos",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "movimientos";

                            }
                        })

            </script>';

            return;
        }

           // ACTUALIZAR STOCK

            $listaProductos = json_decode($_POST["listaProductos2"], true);

            foreach ($listaProductos as $key => $value) {
                
                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ProductModel::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1b = "stock";
                $valor1b = $value["stock"];

                $nuevoStock = ProductModel::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);                

            }

              // GUARDAR LA ENTRADA

                $tabla = "movimientos_inventario";

                $datos = array(
                    "codigo" => $_POST["nuevaEntrada"],
                    "id_usuario" => $_POST["idUser"],                
                    "tipo_movimiento" => $_POST["nuevoTipoMovimiento"],
                    "descripcion" => $_POST["nuevaDescripcionMovimiento"],
                    "productos" => $_POST["listaProductos2"]);

                    $respuesta = MovimientosModel::mdlIngresarMovimiento($tabla, $datos);

                    

                    if ($respuesta == "ok") {
                    
                        echo '<script>
    
                        swal({
    
                            type: "success",
                            title: "¡La entrada de productos ha sido guardada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                            
                                window.location = "movimientos";
    
                            }
    
                        });
                    
    
                        </script>';
    
                    }

                    }

    }

    // CREAR SALIDA

    static public function ctrCrearSalida(){

        if(isset($_POST["nuevaSalida"])){

            if($_POST["listaProductos2"] == ""){

                echo'<script>

            swal({
                  type: "error",
                  title: "El movimiento no se ejecuta si no hay productos",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "movimientos";

                            }
                        })

            </script>';

            return;
        }

           // ACTUALIZAR STOCK

            $listaProductos = json_decode($_POST["listaProductos2"], true); 
            
            
            foreach ($listaProductos as $key => $value) {
                
                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ProductModel::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1b = "stock";
                $valor1b = $value["stock"] - $value["cantidad"]*2;

                $nuevoStock = ProductModel::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);                
   
            }

             // GUARDAR LA SALIDA

                $tabla = "movimientos_inventario";

                $datos = array(
                    "codigo" => $_POST["nuevaSalida"],
                    "id_usuario" => $_POST["idUser"],                
                    "tipo_movimiento" => $_POST["nuevoTipoMovimiento"],
                    "descripcion" => $_POST["nuevaDescripcionMovimiento"],
                    "productos" => $_POST["listaProductos2"]);

                    $respuesta = MovimientosModel::mdlIngresarMovimiento($tabla, $datos);

                    
                    if ($respuesta == "ok") {
                    
                        echo '<script>
    
                        swal({
    
                            type: "success",
                            title: "¡La salida de productos ha sido guardada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
    
                            if(result.value){
                            
                                window.location = "movimientos";
    
                            }
    
                        });
                    
    
                        </script>';
    
                    }

                    }

    }


    // ELIMINAR MOVIMIENTO

    static public function ctrEliminarMovimiento(){

        if(isset($_GET["idMovimiento"])){

            $tabla = "movimientos_inventario";
            $item = "id";
            $valor = $_GET["idMovimiento"];

            $traerMovimientoEntrada = MovimientosModel::mdlMostrarMovimientos($tabla, $item, $valor);

            if($traerMovimientoEntrada["tipo_movimiento"] == "Entrada"){

                MovimientosController::ctrEliminarEntrada();
                
            }else{

                MovimientosController::ctrEliminarSalida();
            }

      
        }

    }

   
   

// RANGO FECHAS

static public function ctrRangoFechasMovimientos($fechaInicial, $fechaFinal){

    $tabla = "movimientos_inventario";

    $respuesta = MovimientosModel::mdlRangoFechasMovimientos($tabla, $fechaInicial, $fechaFinal);
    
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
        
        $Name = $_GET["reporte"].'.xls';

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

        foreach ($ventas as $row => $item){

            $cliente = ClienteController::ctrMostrarClientes("id", $item["id_cliente"]);
            $vendedor = UserController::ctrMostrarUsuarios("id", $item["id_vendedor"]);

         echo utf8_decode("<tr>
                     <td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
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
                <td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
                <td style='border:1px solid #eee;'>$ ".number_format($item["valor_dolar"],2)."</td>
                <td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
                <td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
                <td style='border:1px solid #eee;'>$ ".number_format($item["total_bolivares"],2)."</td>
                <td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
                <td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
                 </tr>");


        }


        echo "</table>";

    }

}





}