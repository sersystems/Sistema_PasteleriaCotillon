<?php

    function consultarDB($consulta){

		//DATOS DE CONEXION WEB
		$db_host = "";
		$db_user = "";
		$db_pass = "";
		$db_name = "";
				
		$cnxSQL = mysqli_connect($db_host, $db_user, $db_pass) or exit("Error WEB001. No se pudo establecer la conexi&oacute;n con la Base de Datos.");
		//Establece el conjunto de caracteres a usar cuando se envian datos desde y hacia el servidor de la base de datos.
		mysqli_set_charset ($cnxSQL , 'UTF8');
		//Selecciona la base de datos que se utilizara para realizar las consultas.
		mysqli_select_db($cnxSQL, $db_name) or die("Error WEB002. No se pudo establecer la conexi&oacute;n con la Base de Datos.");
		//Realiza una consulta en la base de datos
      	$consultaDB = mysqli_query($cnxSQL, $consulta);

      	if ($consultaDB) {
      		return $consultaDB;
      	}else{
        	echo "Error WEB003. No se pudo realizar la consulta de datos.";
        	exit();
      	}
	}
?>

