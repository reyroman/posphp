<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$respuesta = VentasController::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {

	#Capturamos sólo el año y el mes
	$fecha = substr($value["fecha"],0,7);

	#Introducir las fechas en arrayFechas
	array_push($arrayFechas, $fecha);

	#Capturamos las ventas en bolivares
	$arrayVentas = array($fecha => $value["total_bolivares"]);

    #Sumamos los pagos que ocurrieron el mismo mes
	foreach ($arrayVentas as $key => $value) {
		
		$sumaPagosMesBs[$key] += $value;
	}
  
}


$noRepetirFechas = array_unique($arrayFechas);


?>

<!-- GRAFICO DE VENTAS EN BOLIVARES -->

<div class="box box-solid bg-blue-gradient">

    <div class ="box-header">
     
          <i class="fa fa-th"></i>

          <h3 class="box-title">Gráfico de Ventas en Bolivares</h3>
     
    </div>

    <div class="box-body border-radius-none nuevoGraficoVentasBs">

		<div class="chart" id="line-chart-ventasBs" style="height: 250px;"></div>

  </div>


</div>



<script>
	
 var line = new Morris.Line({
    element          : 'line-chart-ventasBs',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$key."', ventas: ".$sumaPagosMesBs[$key]." },";
           

	    }

	    echo "{y: '".$key."', ventas: ".$sumaPagosMesBs[$key]." }";

    }else{

       echo "{ y: '0', ventas: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : 'Bs ',
    gridTextSize     : 10
  });

</script>



