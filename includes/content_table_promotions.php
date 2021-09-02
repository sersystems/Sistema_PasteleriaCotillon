  <?php require_once('process_encodeHTML.php');?>

      <!--===========SEARCH-PRODUCTION==========-->
		<div class="modal fade" id="ventanaModalTabla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content CsVentanaModalSesion">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLabel">Agregar Productos</h5>
	        	<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          	<span aria-hidden="true">&times;</span>
	       	 	</button>
	      	</div>
		      <div class="modal-body">
		      	<!--============TABLE-PRODUCTO============-->
		       	<div class="CsEspaciadorVertical2"> 
			        <div class="row">
			          <div class="col-12">
			            <div class="d-flex">
			              <input type="text" id="id_txtBusqueda" class="col-7 col-md-8 CsBusquedaTransparente" placeholder="Buscar Producto" onkeyup="buscarProduccion()">
			              <select id="id_cmbRubroBusqueda" name="cmbRubroBusqueda" class="col-5 offset-md-1 col-md-3 CsBusquedaTransparente" onchange="buscarProduccion()">
			                <option value="TODOS">TODOS</option>
			                 	<?php 
			                  	$consultaDB = consultarDB("SELECT rubro FROM rubros ORDER BY rubro ASC");
			                   	while ($i = mysqli_fetch_array($consultaDB)){
			                     	echo '<option value="'.$i["rubro"].'">'.$i["rubro"].'</option>';
			                   	}
			                   	mysqli_free_result($consultaDB);
			                 	?>
			              </select>          
			            </div>
			          </div>
			        </div>
		        </div>
		       	<div class="CsEspaciadorVertical2"> 
		          <table id="idTablaResponsive">
		            <thead>
			            <tr>
			             	<th scope="col" class="text-center">#</th>
			             	<th scope="col">Producto</th>
			             	<th scope="col">Costo $</th>
			             	<th scope="col">Margen $</th>
			             	<th scope="col">Precio $</th>
			             	<th scope="col"></th>
			            </tr>
		            </thead>
		            <tbody >
			            <?php 
			             	$consultaDB = consultarDB("SELECT * FROM productos");
			             	while ($i = mysqli_fetch_array($consultaDB)){
			               	$codigo = $i["id"];
			               	echo
				              	'<tr>
				                  <th class="text-center" id="idBusquedaID'.$codigo.'" onclick="agregarProductoPromocion('.$codigo.')">'.$i["id"].'</th>
				                  <td id="idBusquedaNombre'.$codigo.'" onclick="agregarProductoPromocion('.$codigo.')">'.codificarHTML($i["nombre"]).'</td>
				                  <td id="idBusquedaRubro'.$codigo.'" hidden>'.$i["rubro"].'</td>
				                  <td id="idBusquedaCosto'.$codigo.'" onclick="agregarProductoPromocion('.$codigo.')">'.$i["costo"].'</td>
				                  <td id="idBusquedaMargen'.$codigo.'" onclick="agregarProductoPromocion('.$codigo.')">'.$i["margen"].'</td>
				                  <td id="idBusquedaPrecio'.$codigo.'" onclick="agregarProductoPromocion('.$codigo.')">'.$i["precio"].'</td>
				                  <td class="text-right" id="idBusquedaBoton'.$codigo.'" onclick="agregarProductoPromocion('.$codigo.')">
									<img src="img/svg/download_white.svg">
				                  </td>
				                </tr>';
			              }
			              mysqli_free_result($consultaDB);
			            ?>
		            </tbody>
		          </table>
		        </div>
	    		</div>
	    	</div>
	  	</div>
		</div>
