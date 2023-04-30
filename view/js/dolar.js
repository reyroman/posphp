// EDITAR CATEGORIA

$(document).on("click", ".btnEditarDolar", function(){

	var idDolar = $(this).attr("idDolar");

	var datos = new FormData();
	datos.append("idDolar", idDolar);

	$.ajax({
		url: "ajax/dolar.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

			//console.log(respuesta);
     		 $("#editarDolar").val(respuesta["valor_dolar"]);
     		 $("#idDolar").val(respuesta["id"]);

     	}

	})


})









