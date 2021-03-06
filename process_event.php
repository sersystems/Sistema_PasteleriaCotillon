<?php
	session_start();
	require('includes/conexionDB.php');

	$vecDatos = array(
		'idEvento'=>$_POST['txtID'],
		'titulo'=>addslashes(ucwords(mb_strtolower($_POST['txtTitulo'], 'UTF-8'))),
		'subtitulo'=>addslashes(ucwords(mb_strtolower($_POST['txtSubTitulo'], 'UTF-8'))),
		'descripcion'=>addslashes($_POST['txtDescripcion']),
		'imagen1'=>$_POST['txtFotografiaRuta1'],
		'imagen2'=>$_POST['txtFotografiaRuta2'],
		'imagen3'=>$_POST['txtFotografiaRuta3'],
		'imagen4'=>$_POST['txtFotografiaRuta4'],
		'imagen5'=>$_POST['txtFotografiaRuta5'],
		'imagen6'=>$_POST['txtFotografiaRuta6'],
		'estado'=>$_POST['cmbEstado'],
		'fecha'=>date('Y-m-d', strtotime($_POST['txtFecha'])),
		'creacion'=>date('Y-m-d'));

	$vecFotos = array();
	for ($i=1; $i<7; $i++) { 
		$vecFotos['nombre'.$i] = $_FILES['fileFotografia'.$i]['name'];
		$vecFotos['tipo'.$i] = $_FILES['fileFotografia'.$i]['type'];
		$vecFotos['size'.$i] = $_FILES['fileFotografia'.$i]['size'];
		$vecFotos['tmp'.$i] = $_FILES['fileFotografia'.$i]['tmp_name'];
		$vecFotos['ruta'.$i] = 'img/upload/';
		$vecFotos['destino'.$i] = 'img/upload/'.$_FILES['fileFotografia'.$i]['name'];
	}

	if (!empty($vecDatos['idEvento'])){
		if ($_POST['txtControladorDeBoton'] == "Eliminar") {
			//Paso 1: Eliminacion de la imagenes asociadas al registro.
			$consultaDB = consultarDB("SELECT * FROM eventos WHERE id=\"".$vecDatos['idEvento']."\"");
			while ($row = mysqli_fetch_array($consultaDB, MYSQLI_ASSOC)){
               	for ($i=1; $i<7 ; $i++) { 
               		eliminarImagen($vecDatos['imagen'.$i]);
				}
				//Paso 2: Eliminacion del archivo PHP asociada al registro.
 				if (is_file($row["pagina"])) {
					unlink($row["pagina"]);
				}
			}
            mysqli_free_result($consultaDB);

			//Paso 3: Eliminacion de un registro existente
			consultarDB("DELETE FROM eventos WHERE id=\"".$vecDatos['idEvento']."\"");
			header("Location: index_admin_event.php?resultadoProceso=El registro se ha eliminado correctamente");

		}else{

			//Modificacion de un registro existente
			$rutaDeImagen = array('picture1'=>'', 'picture2'=>'', 'picture3'=>'', 'picture4'=>'', 'picture5'=>'', 'picture6'=>'');
			for ($i=1; $i<7; $i++) {
				if ($vecFotos['size'.$i]>0 && empty($vecDatos['imagen'.$i])) {
				//Accion: Agregar una imagen en un panel vacio
					$rutaDeImagen['picture'.$i] = subirImagen($vecFotos['size'.$i], $vecFotos['tipo'.$i], $vecFotos['ruta'.$i], $vecFotos['tmp'.$i], $vecFotos['destino'.$i]);
				}elseif ($vecFotos['size'.$i]>0 && !empty($vecDatos['imagen'.$i])) {
				//Accion: Modificar una imagen en un panel ocupado
					eliminarImagen(trim($vecDatos['imagen'.$i]));
					$rutaDeImagen['picture'.$i] = subirImagen($vecFotos['size'.$i], $vecFotos['tipo'.$i], $vecFotos['ruta'.$i], $vecFotos['tmp'.$i], $vecFotos['destino'.$i]);
				}elseif ($vecFotos['size'.$i]<=0 && !empty($vecDatos['imagen'.$i])) {
					if($_POST['txtFotoControlador'.$i] == "BASURA"){
					//Accion: Eliminar una imagen del panel
						eliminarImagen(trim($vecDatos['imagen'.$i]));		
					}else{
					//Accion: Conservar una imagen del panel
						$rutaDeImagen['picture'.$i] = $vecDatos['imagen'.$i];
					}
				}
			}

			consultarDB("UPDATE eventos SET 
			 	titulo=\"".$vecDatos['titulo']."\"
			 	, subtitulo=\"".$vecDatos['subtitulo']."\"
			 	, descripcion=\"".$vecDatos['descripcion']."\"
			 	, imagen1=\"".($rutaDeImagen['picture1'])."\" 
			 	, imagen2=\"".($rutaDeImagen['picture2'])."\"
			 	, imagen3=\"".($rutaDeImagen['picture3'])."\"
			 	, imagen4=\"".($rutaDeImagen['picture4'])."\"
			 	, imagen5=\"".($rutaDeImagen['picture5'])."\"
			 	, imagen6=\"".($rutaDeImagen['picture6'])."\"
			 	, estado=\"".$vecDatos['estado']."\" 
			 	, fecha=\"".$vecDatos['fecha']."\" 
				WHERE id=\"".$vecDatos['idEvento']."\"");
			header("Location: index_admin_event.php?resultadoProceso=El registro se ha modificado correctamente");
		}

	}else{

		//Creacion de un registro nuevo
		$rutaDeImagen1 = subirImagen($vecFotos['size1'], $vecFotos['tipo1'], $vecFotos['ruta1'], $vecFotos['tmp1'], $vecFotos['destino1']);
		$rutaDeImagen2 = subirImagen($vecFotos['size2'], $vecFotos['tipo2'], $vecFotos['ruta2'], $vecFotos['tmp2'], $vecFotos['destino2']);
		$rutaDeImagen3 = subirImagen($vecFotos['size3'], $vecFotos['tipo3'], $vecFotos['ruta3'], $vecFotos['tmp3'], $vecFotos['destino3']);
		$rutaDeImagen4 = subirImagen($vecFotos['size4'], $vecFotos['tipo4'], $vecFotos['ruta4'], $vecFotos['tmp4'], $vecFotos['destino4']);
		$rutaDeImagen5 = subirImagen($vecFotos['size5'], $vecFotos['tipo5'], $vecFotos['ruta5'], $vecFotos['tmp5'], $vecFotos['destino5']);
		$rutaDeImagen6 = subirImagen($vecFotos['size6'], $vecFotos['tipo6'], $vecFotos['ruta6'], $vecFotos['tmp6'], $vecFotos['destino6']);
		$archivoPHP = "event".rand(1000, 9999).date('dmY').".php";
        $nuevoPHP = fopen($archivoPHP, 'w+');
        fclose($nuevoPHP);
		consultarDB("INSERT INTO eventos (titulo, subtitulo, descripcion, imagen1, imagen2, imagen3, imagen4, imagen5, imagen6, pagina, estado, fecha, creacion)  VALUES 
			(\"".$vecDatos['titulo']."\"
			, \"".$vecDatos['subtitulo']."\"
			, \"".$vecDatos['descripcion']."\"
			, \"".((empty($rutaDeImagen1))? "" : $rutaDeImagen1)."\" 
			, \"".((empty($rutaDeImagen2))? "" : $rutaDeImagen2)."\" 
			, \"".((empty($rutaDeImagen3))? "" : $rutaDeImagen3)."\" 
			, \"".((empty($rutaDeImagen4))? "" : $rutaDeImagen4)."\" 
			, \"".((empty($rutaDeImagen5))? "" : $rutaDeImagen5)."\" 
			, \"".((empty($rutaDeImagen6))? "" : $rutaDeImagen6)."\" 
			, \"".$archivoPHP."\"
			, \"".$vecDatos['estado']."\" 
			, \"".$vecDatos['fecha']."\"
			, \"".$vecDatos['creacion']."\")");
		header("Location: index_admin_event.php?resultadoProceso=El registro se ha isertado correctamente");
	}

	//==========================FUNCIONES DE IMAGEN==========================
	function subirImagen($tamanio, $tipo, $ruta, $tmp, $destino){
		if ($tamanio > 0) {
			if ($tipo=="image/jpeg") {
				if ($tamanio<=2500000) {
					
					//1??: Abre el directorio de trabajo.
					opendir($ruta);
					
					//2??: Mueve la imagen a la carpeta indicada como destino.
					move_uploaded_file($tmp, $destino);
					
					//3??: Generar un nuevo nombre de archivo.
					$extensionDeArchivo = substr($destino, -4);
					$nombreDeArchivosAleatorio = count(glob("img/upload/{*.jpeg,*.jpg,*.png}",GLOB_BRACE)).rand(100000, 999999);
					$nombreDeArchivo = $ruta."event".$nombreDeArchivosAleatorio.$extensionDeArchivo;
					
					//4: Crea una copia estandarizada de la imagen original con nuevo nombre
				    $imgFormato = imagecreatetruecolor(1024, 768);
				    $imgSubida = imagecreatefromjpeg($destino);
				    $y = imagesy($imgSubida);
				    $x = imagesx($imgSubida);
				    if ($x<$y){	//Detecta imagen VERTICAL
					    $a = (100/$y)*($y-768);    	//Calcula el porcentaje para Y en relacion a 768px 
					    $setX = $x-(($x/100)*$a);  	//Calcula el tama??o para X segun el porcentaje de Y
					    $centerX = (1024-$setX)/2;	//Calcula el margen izquierdo para centrar imagen
					    imagecopyresampled($imgFormato, $imgSubida, $centerX, 0, 0, 0, $setX, 768, $x, $y);
					}else{	//Detecta imagen HORIZONTAL
					    imagecopyresampled($imgFormato, $imgSubida, 0, 0, 0, 0, 1024, 768, $x, $y);
					}
					
					//5: Inserta el logo a la nueva imagen 
					$imgLogo = imagecreatefrompng('img/logo_para_fotos.png');
					$x2 = imagesx($imgLogo);
					$y2 = imagesy($imgLogo);
					imagecopyresampled($imgFormato, $imgLogo, 362, 465, 0, 0, 300, 175, $x2, $y2);
					imagejpeg($imgFormato, $nombreDeArchivo, 75);

					unlink($destino);
					imagedestroy($imgSubida); 
					imagedestroy($imgFormato); 
					imagedestroy($imgLogo);

					//6: Crea una segunda copia minimizada de la imagen original 
					$imgNuevaNormal = imagecreatefromjpeg($nombreDeArchivo);
					$imgNuevaMinimizada = imagecreatetruecolor(400, 300);
					$x = imagesx($imgNuevaNormal);
					$y = imagesy($imgNuevaNormal);
					imagecopyresampled($imgNuevaMinimizada, $imgNuevaNormal, 0, 0, 0, 0, 400, 300, $x, $y);
					$imgNombre = str_replace(".jpg", "_min.jpg", $nombreDeArchivo);
					imagejpeg($imgNuevaMinimizada, $imgNombre);
					chmod($imgNombre, 0644);

					return $nombreDeArchivo;

				}else{ header("Location: index_admin_event.php?resultadoProceso=Error, el archivo no debe superar los 2MB."); }
			}else{ header("Location: index_admin_event.php?resultadoProceso=Error, el archivo debe ser de tipo JPG"); }
		}
	}

	function eliminarImagen($imagen){
		if (is_file($imagen)){
			unlink($imagen);
			$imagenMinimizada = str_replace(".jpg", "_min.jpg", $imagen);
			if (is_file($imagenMinimizada)){
				unlink($imagenMinimizada);
			}
		}
	}
?>