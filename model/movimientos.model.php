<?php

require_once "conexion.php";

class MovimientosModel{

     //MOSTRAR VENTAS
     static public function mdlMostrarMovimientos($tabla, $item, $valor)
     {
         if($item != null){
         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item 
         ORDER BY id ASC");
 
         $stmt->bindParam(":" .$item, $valor, PDO::PARAM_STR);
 
         $stmt->execute();
 
         return $stmt->fetch();
 
         }
 
         else{
         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");        
 
         $stmt->execute();
 
         return $stmt->fetchAll();
 
         }
 
 
     }

     // REGISTRO DE MOVIMIENTO
    static public function mdlIngresarMovimiento($tabla, $datos){

        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_usuario, tipo_movimiento, descripcion, productos ) 
        VALUES (:codigo, :id_usuario, :tipo_movimiento, :descripcion, :productos)");

        $stmt->bindParam(':codigo', $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $datos["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(':tipo_movimiento', $datos["tipo_movimiento"], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(':productos', $datos["productos"], PDO::PARAM_STR);
       


        if ($stmt->execute()) {
            return "ok";
           
        } else {
           return "error";

        }
        
       // $stmt->close();

        $stmt = null;

    }   

    // EDITAR MOVIMIENTO    
    static public function mdlEditarMovimiento($tabla, $datos){

        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  codigo = 
        :codigo, id_usuario = :id_usuario, 	tipo_movimiento = :tipo_movimiento, descripcion = :descripcion, 
        productos = :productos WHERE codigo = :codigo");

        $stmt->bindParam(':codigo', $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $datos["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(':tipo_movimiento', $datos["tipo_movimiento"], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(':productos', $datos["productos"], PDO::PARAM_STR);
        

        if ($stmt->execute()) {
            return "ok";
           
        } else {
           return "error";

        }
        
       // $stmt->close();

        $stmt = null;

    }   

     // ELIMINAR VENTA

     static public function mdlEliminarVenta($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";
        }else{
            return "error";
        }

       // $stmt -> close();

        $stmt = null;

    }

//RANGO DE FECHAS

	static public function mdlRangoFechasMovimientos($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

    	
	// SUMAR EL TOTAL DE VENTAS BOLIVARES

	static public function mdlSumaTotalVentasBs($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

    // SUMAR EL TOTAL DE VENTAS DOLARES

	static public function mdlSumaTotalVentasDolares($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
  
   
  
}


