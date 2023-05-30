<?php

require_once "conexion.php";
class ClienteModel{

    //MOSTRAR CLIENTES
    static public function mdlMostrarClientes($tabla, $item, $valor)
    {
        if($item != null){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

        $stmt->bindParam(":" .$item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(); 

        }

        else{
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");        

        $stmt->execute();

        return $stmt->fetchAll();

        }

    }

     // REGISTRO DE CLIENTE
     static public function mdlIngresarCliente($tabla, $datos){
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ci, nombre, email, telefono, direccion, fecha_nacimiento) 
        VALUES (:ci, :nombre, :email, :telefono, :direccion, :fecha_nacimiento)");

        $stmt->bindParam(':ci', $datos["ci"], PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(':email', $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $datos["fecha_nacimiento"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            return "ok";
           
        } else {
           return "error";

        }
        
       // $stmt->close();

        $stmt = null;

    } 

    // EDITAR CLIENTE
    static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ci = :ci, nombre = :nombre,
        email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento
         WHERE id = :id");
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":ci", $datos["ci"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
       
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		//$stmt->close();
		$stmt = null;

	}

    // ACTUALIZAR CLIENTE
    static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

        $stmt = Conexion::conectar()->prepare(" UPDATE $tabla SET $item1 = :$item1 
        WHERE id = :id");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{
        
            return "error";
        }

        $stmt = null;

        }

   
	//BORRAR CLIENTE
	
	static public function mdlBorrarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		//$stmt -> close();

		$stmt = null;

	}

}