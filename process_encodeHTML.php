<?php 

	function codificarHTML($cadena){
		$busqueda= array ("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ");
	    $reemplazo= array ("&aacute;", "&eacute;", "&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;");
	    $texto = str_replace($busqueda, $reemplazo ,$cadena);
	    return $texto;
	} 
?>