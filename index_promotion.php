<?php 
  session_start();
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
      <?php include('process_create_page_promotion.php');?>
      <?php include('process_date_full.php');?>
      <div class="row">
        <h4 class="CsSeccionTitulo animated tada">Cat&aacute;logo</h4>
      </div>
      <div class="col-12">
        <?php 
          include('process_pagination.php');
          crearPaginacion('promociones', 'index_promotion.php', 4);
        ?>
      </div>
      <div class="row">
        <?php
          $consultaDB = consultarDB("SELECT * FROM promociones WHERE estado='ACTIVADO' ORDER BY fecha DESC LIMIT ".paginarConsulta(4));
          while ($row = mysqli_fetch_array($consultaDB, MYSQLI_ASSOC)){
            $alt = "Promocion".$row["id"];
            $precio = ($row["precio_visible"] == "MOSTRAR")? "Precio $".$row["precio"] : "<a Href='index_contact.php'>Consultar Precio</a>";
            $origen = $row["imagen1"];
            $origenMin = str_replace(".jpg", "_min.jpg", trim($row["imagen1"]));
            $archivoPHP = $row['pagina'];
            crearArchivoPHP($archivoPHP, $origen, $alt, $row["titulo"], $row["descripcion"], $row["fecha"], $precio); 

            echo
              '<!-- ==========PROMOCION========== -->
              <div class="col-12 col-md-6 CsEspaciadorVertical1">
                <form action="'.$archivoPHP.'" method="post">
                  <div class="col-12 CsPanelBlog">
                    <!-- =====IMAGEN===== -->
                    <div class="col-12 text-center">
                      <div class="mt-2">
                        <img class="CsimagenMedia" src="'.$origenMin.'" alt="Promoci&oacute;n'.$row["id"].'">
                      </div>
                    </div>
                    <!-- =======DATOS====== -->
                    <div class="col-12">
                      <h4 class="card-title text-center mt-1 mb-2 ">'.codificarHTML($row["titulo"]).'</h4>
                    </div>
                    <div class="col-12">
                      <button type="submit" name="btnVerMas" class="btn btn-danger btn-block mt-2 mb-1 CsBoton CsLetraMasChica">Leer m&aacute;s datos sobre la promoci&oacute;n</button>
                    </div>
                  </div>
                </form>
              </div>';
          }
          mysqli_free_result($consultaDB);
        ?>
      </div>
    </section>


    <!--==============================FOOTER=================================-->
    <?php
      include('includes/content_table_promotions.php');
      include('includes/struct_footer.php');
    ?>

  </body>
</html>
