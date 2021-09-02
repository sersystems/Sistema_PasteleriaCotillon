<?php
  	date_default_timezone_set("America/Argentina/Buenos_Aires");
	setlocale(LC_TIME, 'spanish');
  	
  	function formatearFechaLarga($fecha){
    	$fechaLarga = strftime("%d de %B de %Y", strtotime($fecha));
		return $fechaLarga;	
	}
?>