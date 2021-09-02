<?php 

  //Pagina Protegida: Control de sesion de Administrador. 
  session_start();
  if (!isset($_SESSION['usuario'])){
    echo '<script type="text/javascript"> alert("Para acceder a este contenido tiene que estar logueado"); window.location="index.php";</script>';
  }

  include('includes/struct_head.php');
  require('includes/conexionDB.php');
  require_once('process_encodeHTML.php');
?>

    <!--==============================HEADER=================================-->
    <header>
      <?php include('includes/content_header_session.php');?>
      <?php include('includes/content_header_menu.php');?>
    </header> 
  
    <!--=============================SECTION=================================-->
    <section class="container">
      <div class="row">
        <h4 class="CsSeccionTitulo animated tada">Productos</h4>
      </div>
        <!--=============FORM-PRODUCTO=============-->
        <form id="idFormulario" action="process_production.php" method="post" autocomplete="on">
          <div id="id_MensajeAlerta"><?php
              if(isset($_GET['resultadoProceso'])){
                echo '<p class="CsRespuestaProceso animated infinite pulse">'.$_GET["resultadoProceso"].'</p>';
              }
          ?></div>
          <div class="form-group row">
            <div class="col-6 col-md-2 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Id</span>
              <input type="text" class="form-control text-center" id="id_txtID" name="txtID" readonly>
            </div>
            <div class="col-12 col-md-6 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Producto</span>
              <input type="text" class="form-control" id="id_txtNombre" name="txtNombre" placeholder="Escriba el nombre del Producto" maxlength="75" required>
            </div>
            <div class="col-12 col-md-4 input-group">
              <span class="input-group-addon">Rubro</span>
              <select id="id_cmbRubro" name="cmbRubro" class="form-control" required>
                <option value="" disabled selected>Seleccione un Rubro</option>
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
          <div class="form-group row">
            <div class="col-12 col-md-4 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Costo $</span>
              <input type="text" class="form-control" id="id_txtCosto" name="txtCosto" placeholder="Escriba el costo del Producto" maxlength="12" onkeyup="calcularProduccionMargen()" required>
            </div>
            <div class="col-12 col-md-4 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Ganancia $</span>
              <input type="text" class="form-control font-weight-bold text-right" id="id_txtMargen" name="txtMargen" readonly>
            </div>
            <div class="col-12 col-md-4 input-group">
              <span class="input-group-addon">Precio $</span>
              <input type="text" class="form-control" id="id_txtPrecio" name="txtPrecio" placeholder="Escriba el precio del Producto" maxlength="12" onkeyup="calcularProduccionMargen()" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12 input-group">
              <span class="input-group-addon CsTextoVertical">Observaci&oacute;n</span>
              <textarea class="form-control" id="id_txtObservacion" name="txtObservacion" placeholder="Escriba una observaci&oacute;n sobre el Producto" rows="8" maxlength="1000"></textarea>
            </div>
          </div>
          <div class="row">
            <input type="hidden" id="id_txtControladorDeBoton" name="txtControladorDeBoton">
            <div class="col-4 CsEspaciadorVertical2">
              <button type="button" id="id_btnEliminar" name="btnEliminar" class="btn btn-danger btn-block CsBoton CsLetraMasChica"
              onmousedown="validarBoton('Eliminar', document.getElementById('id_txtNombre').value);">Eliminar</button>
            </div>
            <div class="col-4 CsEspaciadorVertical2">
              <button type="button" id="id_btnGrabar" name="btnGrabar" class="btn btn-danger btn-block CsBoton CsLetraMasChica"
              onmousedown="validarBoton('Guardar', document.getElementById('id_txtNombre').value);">Guardar</button>
            </div>
            <div class="col-4 CsEspaciadorVertical2">
              <button type="reset" name="btnCancelar" class="btn btn-danger btn-block CsBoton CsLetraMasChica">Cancelar</button>
            </div>
          </div>
        </form>

        <!--===============SEPARADOR==============-->
        <div class="col-12">
          <hr class="CsSeparador"> 
        </div>

        <!--============TABLE-PRODUCTO============-->
        <div class="CsEspaciadorVertical1"> 
          <div class="row">
            <div class="col-12">
              <div class="d-flex">
                <input type="text" id="id_txtBusqueda" class="col-7 col-md-8 CsBusquedaTransparente" placeholder="Buscar Producto" onkeyup="buscarElementoSimple('idListaNombre','idListaRubro')">
                <select id="id_cmbRubroBusqueda" name="cmbRubroBusqueda" class="col-5 offset-md-1 col-md-3 CsBusquedaTransparente" onchange="buscarElementoSimple('idListaNombre','idListaRubro')">
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
                  $consultaDB = consultarDB("SELECT * FROM productos ORDER BY nombre");
                  while ($i = mysqli_fetch_array($consultaDB)){
                    $codigo = $i["id"];
                    echo
                    '<tr>
                      <th class="text-center" id="idListaID'.$codigo.'" onclick="mostrarProduccion('.$codigo.')">'.$i["id"].'</th>
                      <td id="idListaNombre'.$codigo.'" onclick="mostrarProduccion('.$codigo.')">'.codificarHTML($i["nombre"]).'</td>
                      <td id="idListaRubro'.$codigo.'" hidden>'.$i["rubro"].'</td>
                      <td id="idListaCosto'.$codigo.'" onclick="mostrarProduccion('.$codigo.')">'.$i["costo"].'</td>
                      <td id="idListaMargen'.$codigo.'" onclick="mostrarProduccion('.$codigo.')">'.$i["margen"].'</td>
                      <td id="idListaPrecio'.$codigo.'" onclick="mostrarProduccion('.$codigo.')">'.$i["precio"].'</td>
                      <td id="idListaObservacion'.$codigo.'" hidden>'.str_replace("\r\n", "<br>", codificarHTML($i["observacion"])).'</td>
                      <td class="text-right" id="idListaBoton'.$codigo.'" onclick="mostrarProduccion('.$codigo.')">
                        <img src="img/svg/edit_white.svg" data-toggle="tooltip" data-placement="left" title="Editar producto">
                      </td>
                    </tr>';
                  }
                  mysqli_free_result($consultaDB);
                ?>
            </tbody>
          </table>
        </div>
    </section>


    <!--==============================FOOTER=================================-->
    <?php include('includes/struct_footer.php');?>

  </body>
</html>
