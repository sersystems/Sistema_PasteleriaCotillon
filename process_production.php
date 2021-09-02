<?php

	session_start();
	require('includes/conexionDB.php');

	$vecDatos = array(
		'idProducto'=>$_POST['txtID'],
		'nombre'=>addslashes(ucwords(mb_strtolower($_POST['txtNombre'], 'UTF-8'))),
		'rubro'=>$_POST['cmbRubro'],
		'costo'=>$_POST['txtCosto'],
		'precio'=>$_POST['txtPrecio'],
		'margen'=>$_POST['txtMargen'],
		'observacion'=>addslashes($_POST['txtObservacion']),
		'creacion'=>date('Y-m-d'));

	if (!empty($vecDatos['idProducto'])){
		if ($_POST['txtControladorDeBoton'] == "Eliminar") {
			//Eliminacion de un registro existente
			consultarDB("DELETE FROM productos WHERE id=\"".$vecDatos['idProducto']."\"");
			header("Location: index_admin_production.php?resultadoProceso=El registro se ha eliminado correctamente");
		}else{
			//Modificacion de un registro existente
			consultarDB("UPDATE productos SET 
				nombre=\"".$vecDatos['nombre']."\"
				, rubro=\"".$vecDatos['rubro']."\"
				, costo=\"".$vecDatos['costo']."\"
				, precio=\"".$vecDatos['precio']."\" 
				, margen=\"".$vecDatos['margen']."\" 
				, observacion=\"".$vecDatos['observacion']."\" 
				WHERE id=\"".$vecDatos['idProducto']."\"");
			header("Location: index_admin_production.php?resultadoProceso=El registro se ha modificado correctamente");
		}

	}else{

		//Creacion de un registro nuevo
		consultarDB("INSERT INTO productos (nombre, rubro, costo, precio, margen, observacion, creacion)  VALUES 
			(\"".$vecDatos['nombre']."\"
			, \"".$vecDatos['rubro']."\"
			, \"".$vecDatos['costo']."\"
			, \"".$vecDatos['precio']."\" 
			, \"".$vecDatos['margen']."\"
			, \"".$vecDatos['observacion']."\"
			, \"".$vecDatos['creacion']."\")");
		header("Location: index_admin_production.php?resultadoProceso=El registro se ha insertado correctamente");
	}
?>
