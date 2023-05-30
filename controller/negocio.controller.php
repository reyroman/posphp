<?php

class NegocioController{
  
      // MOSTRAR DATOS DEL NEGOCIO
      static public function ctrMostrarNegocio($item, $valor){
        $tabla = "config";
        $respuesta = NegocioModel::mdlMostrarNegocio($tabla, $item, $valor);
        return $respuesta;
    }

}