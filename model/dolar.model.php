<?php

require_once "conexion.php";
class DolarModel{

    //MOSTRAR VALOR DOLAR
    static public function mdlMostrarDolar($tabla, $item, $valor)
    {
        if($item != null){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":" .$item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        }

        else{
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");        

        $stmt->execute();

        return $stmt->fetchAll();

        }


    }

  

    // EDITAR VALOR DEL DOLAR
    static public function mdlEditarDolar($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valor_dolar = :valor_dolar WHERE id = :id");

		$stmt -> bindParam(":valor_dolar", $datos["valor_dolar"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		//$stmt->close();
		$stmt = null;


	}

 

}