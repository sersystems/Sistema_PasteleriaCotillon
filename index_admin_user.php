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
        <h4 class="CsSeccionTitulo animated tada">Usuarios</h4>
      </div>
        <!--=============FORM-PRODUCTO=============-->
        <form id="idFormulario" action="process_user.php" method="post" autocomplete="on">
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
            <div class="col-12 col-md-10 input-group">
              <span class="input-group-addon">Nombre</span>
              <input type="text" class="form-control" id="id_txtNombre" name="txtNombre" placeholder="Escriba su Apellido y Nombre" maxlength="30" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12 col-md-6 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Usuario</span>
              <input type="text" class="form-control" id="id_txtUsuario" name="txtUsuario" placeholder="Escriba el nombre de Usuario" minlength="6" maxlength="8" required>
            </div>
            <div class="col-12 col-md-6 input-group CsEspaciadorVertical1">
              <span class="input-group-addon">Clave</span>
              <input type="password" class="form-control" id="id_txtClave" name="txtClave" placeholder="Escriba la clave de Usuario" minlength="6" maxlength="8" required>
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

        <!--============TABLE-USUARIOS============-->
        <div class="CsEspaciadorVertical1"> 
          <div class="row">
            <div class="col-12">
              <div class="d-flex">
                <input type="text" id="id_txtBusqueda" class="col-12 CsBusquedaTransparente" placeholder="Buscar Usuario" onkeyup="buscarElementoSimple('idListaNombre','SINGULAR')">
              </div>
            </div>
          </div>

          <table id="idTablaResponsive">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Usuario</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody >
               <?php 
                  require_once('process_crypt.php');
                  $consultaDB = consultarDB("SELECT * FROM usuarios ORDER BY nombre");
                  while ($i = mysqli_fetch_array($consultaDB)){
                    $codigo = $i["id"];
                    echo
                    '<tr>
                      <th class="text-center" id="idListaID'.$codigo.'" onclick="mostrarUsuario('.$codigo.')">'.$i["id"].'</th>
                      <td id="idListaNombre'.$codigo.'" onclick="mostrarUsuario('.$codigo.')">'.codificarHTML($i["nombre"]).'</td>
                      <td id="idListaUsuario'.$codigo.'" onclick="mostrarUsuario('.$codigo.')">'.desencriptar($i["usuario"]).'</td>
                      <td id="idListaClave'.$codigo.'" onclick="mostrarUsuario('.$codigo.')" hidden>'.desencriptar($i["clave"]).'</td>
                      <td class="text-right" id="idListaBoton'.$codigo.'" onclick="mostrarUsuario('.$codigo.')">
                        <img src="img/svg/edit_white.svg"  data-toggle="tooltip" data-placement="left" title="Editar usuario">
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
