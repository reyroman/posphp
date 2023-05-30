// VARIABLE LOCAL STORAGE

if(localStorage.getItem("capturarRango2") != null){

	$("#daterangeReportes-btn span").html(localStorage.getItem("capturarRango2"));

}else{

	$("#daterangeReportes-btn span").html('<i class="fa fa-calendar" ></i> Rango de fecha');

}

//RANGO DE FECHAS

$('#daterangeReportes-btn').daterangepicker(
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
	  $('#daterangeReportes-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  
	  var fechaInicial = start.format('YYYY-MM-DD');

	  console.log('fechaInicial', fechaInicial);
  
	  var fechaFinal = end.format('YYYY-MM-DD');

	  console.log('fechaFinal', fechaFinal);
  
	  var capturarRango = $("#daterangeReportes-btn span").html();
	 
		 localStorage.setItem("capturarRango2", capturarRango);
  
		 window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
	}
  
  )

  // CANCELAR RANGO DE FECHAS

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango2");
	localStorage.clear();
	window.location = "reportes";
})


// CAPTURAR HOY


$(".daterangepicker.opensright .ranges li").on("click", function(){

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

    	localStorage.setItem("capturarRango2", "Hoy");

    	window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})