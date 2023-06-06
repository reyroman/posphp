 //CARGAR TABLA DINAMICA DE PRODUCTOS

// $.ajax({

// url: "ajax/datatable-ventas.ajax.php",
// success:function(respuesta){
//      console.log("respuesta", respuesta);

//  }

//  })

// VARIABLE LOCAL STORAGE

if(localStorage.getItem("capturarRango3") != null){

	$("#daterange-btn3 span").html(localStorage.getItem("capturarRango3"));

}else{

	$("#daterange-btn3 span").html('<i class="fa fa-calendar" ></i> Rango de fecha');

}

// CARGA DE TABLA DINAMICA

 $('.tablaMovimientos').DataTable( {
    "ajax": "ajax/datatable-movimientos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

// AGREGAR PRODUCTO AL PRESIONAR ENTER

$(document).ready(function() {
	var table = $('.tablaMovimientos').DataTable();
  
	$('.input-sm').on('keydown', function(event) {
	  if (event.keyCode === 13) { // Si se presiona la tecla Enter
		var rows = table.rows({ search: 'applied' }).nodes(); // Obtener las filas filtradas
  
		if (rows.length === 1) { // Si hay solo una fila filtrada
		  $(rows).find('.btnAgregarProducto').click(); // Hacer clic en el botón "Agregar producto" de esa fila
		  event.preventDefault(); // Prevenir la acción predeterminada de la tecla Enter (submit del formulario)
		  $('.recuperarBoton2').click();
		  $('.input-sm').val("");
		}
	  }
	});
  });

// AGREGANDO PRODUCTOS AL MOVIMIENTO DE INVENTARIO DESDE LA TABLA

$(".tablaMovimientos tbody").on("click", "button.agregarProducto", function(){

	
    var idProducto = $(this).attr("idProducto");
    	
	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	var datos = new FormData();
	datos.append("idProducto", idProducto);
	
	$.ajax({

		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success: function(respuesta){

		    var descripcion = respuesta["descripcion"];
			var stock = respuesta["stock"];
			
			// EVITAR AGREGAR PRODUCTO SI EL STOCK ESTA EN CERO

				
			$(".nuevoProducto").append(
			
			'<div class="row" style="padding: 5px 15px;">'+
			
			'<!-- DESCRIPCION DEL PRODUCTO -->'+

                   '<div class="col-xs-9" style="padding-right:0px;">'+

                    '<div class="input-group">'+

                      '<span class="input-group-addon"><button type="botton" class="btn btn-danger btn-xs quitarProducto2" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                      '<input type="text" class="form-control nuevaDescripcionProducto"  value="'+descripcion+'" idProducto="'+idProducto+'" name="agregarProducto" placeholder="Descripcion del producto" readonly required>'+
                    
					  '</div>'+

                  '</div>'+ 

                  '<!-- CANTIDAD DEL PRODUCTO -->'+

                   '<div class="col-xs-3">'+

                    '<input type="number" step="any"  min="0.1" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock+1)+'" required>'+

                  '</div>'+
				  

                '</div>')

				listarProductos2()
			
		}
		
	})

});

$(".tablaMovimientos").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto2") != null){

		var listaIdProducto = JSON.parse(localStorage.getItem("quitarProducto2"));

		for(var i = 0; i< listaIdProducto.length; i++){

			$("button.recuperarBoton2[idProducto='"+listaIdProducto[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton2[idProducto='"+listaIdProducto[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
		}

	} 

})

// document.addEventListener("DOMContentLoaded", function() {
//     listarProductos2()
// });

// QUITAR PRODUCTOS Y RECUPERAR BOTON

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto2");

$(".formularioMovimientos").on("click", "button.quitarProducto2", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	// ALMACENANDO EN EL LOCALSTORAGE EL ID DE PRODUCTO

	if(localStorage.getItem("quitarProducto2") == null){

		idQuitarProducto = [];

	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto2"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto2", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton2[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton2[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	listarProductos2()
})



//AGREGANDO PRODUCTOS DESDE EL BOTON PARA DISPOSITIVOS

var numProducto = 0;

$(".btnAgregarProducto").click(function(){

	numProducto++;

	var datos = new FormData();

	datos.append("traerProductos", "ok");

	$.ajax({

		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

					
			$(".nuevoProducto").append(
			
				'<!-- DESCRIPCION DEL PRODUCTO -->'+
	
				'<div class="row" style="padding: 5px 15px;">'+
	
					   '<div class="col-xs-9" style="padding-right: 0px;">'+
	
						'<div class="input-group">'+
						  '<span class="input-group-addon"><button type="botton" class="btn btn-danger btn-xs quitarProducto2" idProducto>'+
							  '<i class="fa fa-times"></i></button></span>'+
	
						  '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+
						'<option>Seleccione el producto</option>'+

						'</select>'+
						
						  '</div>'+
	
					  '</div>'+ 
	
					  '<!-- CANTIDAD DEL PRODUCTO -->'+
	
					   '<div class="col-xs-3 ingresoCantidad">'+
	
						'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" '+
						  'min="1" value="1" stock nuevoStock required>'+
	
					  '</div>');

					  // AGREGAR LOS PRODUCTOS AL SELECT

					  respuesta.forEach(funcionForEach);

					  function funcionForEach(item, index){

						if(item.stock != 0){

							$("#producto"+numProducto).append(

								'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
							)
						}
						
					
						
					  }
			
		
		}
		})

})

// SELECCIONAR PRODUCTO

$(".formularioMovimientos").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();
	
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
	
    var datos = new FormData();
	datos.append("nombreProducto", nombreProducto);


	$.ajax({

		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){


			$(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
			$(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"]+1));
		

			listarProductos2()

		
		}
})

})

// MODIFICAR LA CANTIDAD DE PRODUCTOS EN ENTRADA

$(".formularioMovimientos").on("change", "input.nuevaCantidadProducto", function(){

	
	var nuevoStock =  Number($(this).attr("stock")) + Number($(this).val());

	$(this).attr("nuevoStock", nuevoStock);

	//console.assert(nuevoStock);

    listarProductos2()
})

// MODIFICAR LA CANTIDAD DE PRODUCTOS EN ENTRADA

$(".formularioMovimientosSalida").on("change", "input.nuevaCantidadProducto", function(){

	
	var nuevoStock =  Number($(this).attr("stock")) - Number($(this).val());

	$(this).attr("nuevoStock", nuevoStock);

	//console.assert(nuevoStock);

    listarProductos2()
})


// LISTAR TODOS LOS PRODUCTOS

	function listarProductos2(){

		var listaProductos2 = [];

		var id;
		var descripcion = $(".nuevaDescripcionProducto");
		var cantidad = $(".nuevaCantidadProducto");
	

	 for (var i = 0; i < descripcion.length; i++){
	  
	 listaProductos2.push({"id": $(descripcion[i]).attr("idProducto"), 
						  "descripcion": $(descripcion[i]).val(),
						  "cantidad": $(cantidad[i]).val(),
						  "stock": $(cantidad[i]).attr("nuevoStock")})
  
	 }

	 	 
	    $("#listaProductos2").val(JSON.stringify(listaProductos2));
	 	console.log(listaProductos2);

	}


// BOTON EDITAR MOVIMIENTO
$(".tabla").on("click", ".btnEditarMovimiento", function(){

		var idVenta = $(this).attr("idMovimiento");

		window.location = "index.php?ruta=editar-movimiento&idMovimiento="+idVenta;
		
	})

	function quitarAgregarProducto2(){

		// CAPTURAR TODOS LOS ID DE LOS PRODUCTOS QUE FUERON ELEGIDOS EN LA VENTA 
		var idProductos = $(".quitarProducto2");

		// CAPTURAR TODOS LOS BOTONES DE AGREGAR QUE APARECEN EN LA PANTALLA 

		var botonesTabla = $(".tablaMovimientos tbody button.agregarProducto");

		for(var i = 0; i < idProductos.length; i++){

			var boton = $(idProductos[i]).attr("idProducto");

			for(var j = 0; j < botonesTabla.length; j++){

				if($(botonesTabla[j]).attr("idProducto") == boton){

					$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
					$(botonesTabla[j]).addClass("btn-default");

				}
			}

		}

	}

	// EJECUTAR LA FUNCION CADA VEZ QUE CARGUE LA TABLA

	$('.tablaMovimientos').on('draw.dt', function(){

		quitarAgregarProducto2();
	
	})

	// BORRAR MOVIMIENTO

	$(".tabla").on("click", ".btnEliminarMovimiento", function(){

		var idMovimiento = $(this).attr("idMovimiento");

		swal({
			title: '¿Está seguro de borrar el movimiento de inventario ?',
			text: "¡Si no lo está puede cancelar la acción!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, borrar movimiento!'
		}).then((result) => {
			if (result.value){

				window.location = "index.php?ruta=movimientos&idMovimiento="+idMovimiento;
			}
		})

	})

// IMPRIMIR FACTURA

$(".tabla").on("click", ".btnImprimirMovimiento", function(){

	var codigoMovimiento = $(this).attr("codigoMovimiento");

	window.open("extensions/tcpdf/pdf/movimiento.php?codigo="+codigoMovimiento, "_blank");

})

//RANGO DE FECHAS

$('#daterangeMovimientos-btn').daterangepicker(
	{
	  ranges   : {
		'Hoy'       : [moment(), moment()],
		'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
		'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
		'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
		'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  },
	  startDate: moment(),
	  endDate  : moment()
	},
	function (start, end) {
	  $('#daterangeMovimientos-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  
	  var fechaInicial = start.format('YYYY-MM-DD');
 
	  var fechaFinal = end.format('YYYY-MM-DD');
  
	  var capturarRango = $("#daterangeMovimientos-btn span").html();
	 
		 localStorage.setItem("capturarRango3", capturarRango);


		 window.location = "index.php?ruta=movimientos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
	}
  
  )

 
// CANCELAR RANGO DE FECHAS

$(".daterangepicker.openscenter .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango3");
	localStorage.clear();

	window.location = "movimientos";
		
	
})

// CAPTURAR HOY


$(".daterangepicker.openscenter .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		dia = ("0"+dia).slice(-2);
		mes = ("0"+mes).slice(-2);

		var fechaInicial = año+"-"+mes+"-"+dia;
		var fechaFinal = año+"-"+mes+"-"+dia;	

    	localStorage.setItem("capturarRango3", "Hoy");

		window.location = "index.php?ruta=movimientos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

				
	}

})




