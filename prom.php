<?php

/**
* 
* cada individuo consta de 18 bits cada 6 bits representa una cantidad
* los primeros 6: el numero de MB (de izquierda a derecha)
* siguientes 6 bits: el numero de B
* siguientes 6 bits: el numero de S
*/

//longitud de cada individuo o cromosoma
$len_cromosoma = 18;

//longitud de cada componenete del vector calificacion
DEFINE('_LEN_CALIFICACION', 6);

//valores para las calificaciones
DEFINE('_MB', 10);
DEFINE('_B', 8);
DEFINE('_S', 6);


/**
* 
* Estos son los parametros iniciales
* 
*/

//las cantidades de MB, B y S actuales (estos son los parametros in)


$actuales['mb'] = 1;
$actuales['b'] = 0;
$actuales['s'] = 1;

//zigma es el promedio buscado
$promedioDeseado = 9;


/**
* 
* inicio del programa
* 
*/


function calculaAptitud( $poblacion, $actuales, $promedioDeseado){
  
	
	//arreglo que contiene la aptidud de la poblacion
	$aptitud = array();
	
	foreach ( $poblacion as $individuo ){
		$vector = vectorCalificaciones($individuo);
		$totalMB = (bindec($vector['mb']) + $actuales['mb']) * _MB;
		$totalB = (bindec($vector['b']) + $actuales['b']) * _B;
		$totalS = (bindec($vector['s']) + $actuales['s']) * _S;
		
		$sumaVector = bindec($vector['mb']) + bindec($vector['b']) + bindec($vector['s']);

		$promedioCalculado = ($totalMB + $totalB + $totalS) / (array_sum($actuales) + $sumaVector);
						
		$aptitud[] = 10 / (abs($promedioCalculado - $promedioDeseado)  + 1);
	}	
	
	return $aptitud;
	
}



//convierte un individuo a un vector de calificaciones
function vectorCalificaciones($individuo){
	
	$bitsMB = substr($individuo, 0, _LEN_CALIFICACION);
	$bitsB = substr($individuo, _LEN_CALIFICACION, _LEN_CALIFICACION);
	$bitsS = substr($individuo, _LEN_CALIFICACION*2, _LEN_CALIFICACION);
	
	
	$vector['mb'] = $bitsMB;
	$vector['b'] = $bitsB;
	$vector['s'] = $bitsS;
	
	return $vector;
}

$poblacion[] = '000010000000000000';
$poblacion[] = '000000000001000000';
$poblacion[] = '000000000000000001';
$poblacion[] = '000001000000000000';



print_r(calculaAptitud($poblacion, $actuales, $promedioDeseado) );

?>
