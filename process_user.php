<?php
	session_start();
	require_once('includes/conexionDB.php');
	require_once('process_crypt.php');

	$vecDatos = array(
		'idUsuario'=>$_POST['txtID'],
		'nombre'=>addslashes(ucwords(mb_strtolower($_POST['txtNombre'], 'UTF-8'))),
		'usuario'=>encriptar(strtolower($_POST['txtUsuario'])),
		'clave'=>encriptar(strtolower($_POST['txtClave'])),
		'creacion'=>date('Y-m-d'));


	if (!empty($vecDatos['idUsuario'])){
		if ($_POST['txtControladorDeBoton'] == "Eliminar") {
			//Eliminacion de un registro existente
			consultarDB("DELETE FROM usuarios WHERE id=\"".$vecDatos['idUsuario']."\"");
			header("Location: index_admin_user.php?resultadoProceso=El registro se ha eliminado correctamente");
		}else{
			//Modificacion de un registro existente
			consultarDB("UPDATE usuarios SET 
				nombre=\"".$vecDatos['nombre']."\"
				, usuario=\"".$vecDatos['usuario']."\"
				, clave=\"".$vecDatos['clave']."\" 
				WHERE id=\"".$vecDatos['idUsuario']."\"");
			header("Location: index_admin_user.php?resultadoProceso=El registro se ha modificado correctamente");
		}

	}else{
		
		//Creacion de un registro nuevo
		consultarDB("INSERT INTO usuarios (nombre, usuario, clave, cookie, creacion)  VALUES 
			(\"".$vecDatos['nombre']."\"
			, \"".$vecDatos['usuario']."\"
			, \"".$vecDatos['clave']."\"
			, \"\"
			, \"".$vecDatos['creacion']."\")");
		header("Location: index_admin_user.php?resultadoProceso=El registro se ha insertado correctamente");
	}
?>