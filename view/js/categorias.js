// EDITAR CATEGORIA

$(document).on("click", ".btnEditarCategoria", function(){

	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

			//console.log(respuesta);
     		 $("#editarCategoria").val(respuesta["nombre"]);
     		 $("#idCategoria").val(respuesta["id"]);

     	}

	})


})


// REVISAR SI EL USUARIO YA ESTA REGISTRADO

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-danger">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})
})

// ELIMINAR CATEGORIA

$(document).on("click", ".btnEliminarCategoria", function(){

    var idCategoria = $(this).attr("idCategoria");
  
    swal({
      title: '¿Está seguro de borrar la categoria?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar categoria!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
  
      }
  
    })
  
  })







