

//================================FUNCIONES================================
if (document.getElementById("id_MensajeAlerta")) {
	setTimeout(function(){document.getElementById("id_MensajeAlerta").innerText=""}, 6000); //Muestra un mensaje de Alerta
}

function validarBoton(accion, controlador){
	var control = document.getElementById("id_txtID").value;
	if (control > 0 || controlador.length > 0) {
	    if (confirm('¿Estas seguro que desea '+accion+' el registro actual?')){ 
			document.getElementById('id_txtControladorDeBoton').value = accion;
	    	document.getElementById('idFormulario').submit();
	    }else{
			document.getElementById('id_txtControladorDeBoton').value = "";
	    }
	}else{ 
		alert('¡Imposible '+accion+'! Primero seleccione un registro.');
	}
}

function seleccionarImagen(input, identificador1, identificador2) {
	if(input.files && input.files[0]) {
    	var reader = new FileReader();
	    reader.onload = function(e) {
	    	document.getElementById(identificador1).src = e.target.result;
    		document.getElementById(identificador2).value = "ARCHIVO";
	    }
    	reader.readAsDataURL(input.files[0]);
  	}
}

function deseleccionarImagen(identificador1, identificador2, identificador3){
	document.getElementById(identificador1).src = "";
	document.getElementById(identificador2).value = "";
	document.getElementById(identificador3).value = "BASURA";

}

function buscarElementoSimple(identificador1, identificador2) {
	var tablaHTML = document.getElementById("idTablaResponsive");
	var textoHTML = document.getElementById("id_txtBusqueda").value.toUpperCase();
	document.getElementById("id_txtBusqueda").value = textoHTML;

	if (obtenerIndiceDeCampo(identificador1) >= 0) {
		//Recorre todas las filas de la tablaHTML.
		for (var i=1; i<tablaHTML.rows.length; i++){
			campo1 = tablaHTML.rows[i].cells[obtenerIndiceDeCampo(identificador1)].innerHTML.toUpperCase();
			resultado = false;
			//Verifica que se visualicen todas las filas si se ha borrado todo el texto de búsqueda.  
		 	if (textoHTML.length <= 0){
				//Define si el condicional de la busqueda es singular o doble (Utiliza dos condiciones).
		 		if(identificador2!="SINGULAR"){
					var rubroHTML = document.getElementById("id_cmbRubroBusqueda").value.toUpperCase();
		 			campo2 = tablaHTML.rows[i].cells[obtenerIndiceDeCampo(identificador2)].innerHTML.toUpperCase();
		 			if(rubroHTML == "TODOS" || campo2.indexOf(rubroHTML) > -1) resultado = true; 
		 		}else{
		 			resultado = true;
		 		}
		 	}else{
				//Define si el condicional de la busqueda es singular o doble (Utiliza dos condiciones).
		 		if(identificador2!="SINGULAR"){
					var rubroHTML = document.getElementById("id_cmbRubroBusqueda").value.toUpperCase();
		 			campo2 = tablaHTML.rows[i].cells[obtenerIndiceDeCampo(identificador2)].innerHTML.toUpperCase();
		 			//Compara los valores de ambas variables y verifica que coincidan dichos valores.  
			 		if(campo1.indexOf(textoHTML) > -1){
			 			//Verifica que coincidan los valores del campoRubro con el rubroHTML.
			 			if(rubroHTML == "TODOS" || campo2.indexOf(rubroHTML) > -1)	resultado = true; 
				 	} 
		 		}else{
		 			//Compara los valores de la variables y verifica que coincidan dichos valores.  
		 			if(campo1.indexOf(textoHTML) > -1) resultado = true;
		 		}
		 	}

			if(resultado) {
				//Si se encontro una coincidencia, muestra la fila de la tablaHTML.
				tablaHTML.rows[i].style.display = "";
			}else {
				//Si No se encontro ninguna coincidencia, oculta la fila de la tablaHTML.
				tablaHTML.rows[i].style.display = "none";
			}
		}
	}
	function obtenerIndiceDeCampo(identificadorX){
		indiceDecampo = -1;
		for (var i=0; i<tablaHTML.rows[1].cells.length; i++){
			var identificadorDeCampo = tablaHTML.rows[1].cells[i].id;
			if (identificadorDeCampo.indexOf(identificadorX) != -1) {
				indiceDecampo = i;
				return indiceDecampo;
			}
		}	
	}	
}


//-------------ARTICULOS--------------
function mostrarArticulo(codigo) {
	var varId = "idListaID"+codigo;
	var varFecha = "idListaFecha"+codigo;
	var varEstado = "idListaEstado"+codigo;
	var varTitulo = "idListaNombre"+codigo;
	var varDescripcion = "idListaDescripcion"+codigo;
	var varImagen1 = "idListaImagen1"+codigo;

	document.getElementById("id_txtID").value = document.getElementById(varId).innerText;
	document.getElementById("id_txtFecha").value = document.getElementById(varFecha).innerText;
	document.getElementById("id_cmbEstado").value = document.getElementById(varEstado).innerText;
	document.getElementById("id_txtTitulo").value = document.getElementById(varTitulo).innerText;
	document.getElementById("id_txtDescripcion").value = document.getElementById(varDescripcion).innerText;
	for (var i=1; i<2; i++) {
		var varImagen = "idListaImagen"+i+codigo;
		document.getElementById("id_txtFotografiaRuta"+i).value = document.getElementById(varImagen).innerText;
		document.getElementById("id_panelImagen"+i).src = document.getElementById(varImagen).innerText;
		document.getElementById("id_txtFotoControlador"+i).value = "";
	}
}

function cancelarArticulo(){
	for (var i=1; i<2; i++) {
		document.getElementById("id_panelImagen"+i).src = "";
	}
}


//--------------EVENTOS---------------
function mostrarEvento(codigo) {
	var varId = "idListaID"+codigo;
	var varFecha = "idListaFecha"+codigo;
	var varEstado = "idListaEstado"+codigo;
	var varTitulo = "idListaNombre"+codigo;
	var varSubTitulo = "idListaSubNombre"+codigo;
	var varDescripcion = "idListaDescripcion"+codigo;
	var varImagen1 = "idListaImagen1"+codigo;
	var varImagen2 = "idListaImagen2"+codigo;
	var varImagen3 = "idListaImagen3"+codigo;
	var varImagen4 = "idListaImagen4"+codigo;
	var varImagen5 = "idListaImagen5"+codigo;
	var varImagen6 = "idListaImagen6"+codigo;

	document.getElementById("id_txtID").value = document.getElementById(varId).innerText;
	document.getElementById("id_txtFecha").value = document.getElementById(varFecha).innerText;
	document.getElementById("id_cmbEstado").value = document.getElementById(varEstado).innerText;
	document.getElementById("id_txtTitulo").value = document.getElementById(varTitulo).innerText;
	document.getElementById("id_txtSubTitulo").value = document.getElementById(varSubTitulo).innerText;
	document.getElementById("id_txtDescripcion").value = document.getElementById(varDescripcion).innerText;
	for (var i=1; i<7; i++) {
		var varImagen = "idListaImagen"+i+codigo;
		document.getElementById("id_txtFotografiaRuta"+i).value = document.getElementById(varImagen).innerText;
		document.getElementById("id_panelImagen"+i).src = document.getElementById(varImagen).innerText;
		document.getElementById("id_txtFotoControlador"+i).value = "";
	}
}

function cancelarEvento(){
	for (var i=1; i<7; i++) {
		document.getElementById("id_panelImagen"+i).src = "";
	}
}


//-------------PRODUCCION-------------
function mostrarProduccion(codigo) {
	var varId = "idListaID"+codigo;
	var varNombre = "idListaNombre"+codigo;
	var varRubro = "idListaRubro"+codigo;
	var varCosto = "idListaCosto"+codigo;
	var varMargen = "idListaMargen"+codigo;
	var varPrecio = "idListaPrecio"+codigo;
	var varObservacion = "idListaObservacion"+codigo;

	document.getElementById("id_txtID").value = document.getElementById(varId).innerText;
	document.getElementById("id_txtNombre").value = document.getElementById(varNombre).innerText;
	document.getElementById("id_cmbRubro").value = document.getElementById(varRubro).innerText;
	document.getElementById("id_txtCosto").value = document.getElementById(varCosto).innerText;
	document.getElementById("id_txtMargen").value = document.getElementById(varMargen).innerText;
	document.getElementById("id_txtPrecio").value = document.getElementById(varPrecio).innerText;
	document.getElementById("id_txtObservacion").value = document.getElementById(varObservacion).innerText;
}

function calcularProduccionMargen(){
	precio = document.getElementById("id_txtPrecio").value;
	costo = document.getElementById("id_txtCosto").value;
	margen = precio - costo;
	document.getElementById("id_txtMargen").value = margen;
}


//-------------PROMOCION--------------
function mostrarPromocion(codigo) {
	var varId = "idListaID"+codigo;
	var varFecha = "idListaFecha"+codigo;
	var varEstado = "idListaEstado"+codigo;
	var varTitulo = "idListaNombre"+codigo;
	var varRubro = "idListaRubro"+codigo;
	var varCosto = "idListaCosto"+codigo;
	var varMargen = "idListaMargen"+codigo;
	var varPrecio = "idListaPrecio"+codigo;
	var varPrecioVisible = "idListaPrecioVisible"+codigo;
	var varDescripcion = "idListaDescripcion"+codigo;
	var varImagen1 = "idListaImagen1"+codigo;

	document.getElementById("id_txtID").value = document.getElementById(varId).innerText;
	document.getElementById("id_txtFecha").value = document.getElementById(varFecha).innerText;
	document.getElementById("id_cmbEstado").value = document.getElementById(varEstado).innerText;
	document.getElementById("id_txtTitulo").value = document.getElementById(varTitulo).innerText;
	document.getElementById("id_cmbRubro").value = document.getElementById(varRubro).innerText;
	document.getElementById("id_txtCosto").value = document.getElementById(varCosto).innerText;
	document.getElementById("id_txtMargen").value = document.getElementById(varMargen).innerText;
	document.getElementById("id_txtPrecio").value = document.getElementById(varPrecio).innerText;
	document.getElementById("id_cmbPrecioVisible").value = document.getElementById(varPrecioVisible).innerText;
	document.getElementById("id_txtDescripcion").value = document.getElementById(varDescripcion).innerText;
	for (var i=1; i<2; i++) {
		var varImagen = "idListaImagen"+i+codigo;
		document.getElementById("id_txtFotografiaRuta"+i).value = document.getElementById(varImagen).innerText;
		document.getElementById("id_panelImagen"+i).src = document.getElementById(varImagen).innerText;
		document.getElementById("id_txtFotoControlador"+i).value = "";
	}
}

function agregarProductoPromocion(codigo){
	var varDescripcion = document.getElementById("id_txtDescripcion").value;length==0
	if(varDescripcion.length!=0){
		varDescripcion += "\r\n";
	} 
	var varProductoBuscado = varDescripcion+document.getElementById("idBusquedaNombre"+codigo).innerText;
	document.getElementById("id_txtDescripcion").value = varProductoBuscado;
}

function cancelarPromocion(){
	document.getElementById("id_panelImagen1").src = "";
}


//--------------USUARIOS--------------
function mostrarUsuario(codigo) {
	var varId = "idListaID"+codigo;
	var varNombre = "idListaNombre"+codigo;
	var varUsuario = "idListaUsuario"+codigo;
	var varClave = "idListaClave"+codigo;

	document.getElementById("id_txtID").value = document.getElementById(varId).innerText;
	document.getElementById("id_txtNombre").value = document.getElementById(varNombre).innerText;
	document.getElementById("id_txtUsuario").value = document.getElementById(varUsuario).innerText;
	document.getElementById("id_txtClave").value = document.getElementById(varClave).innerText;
}