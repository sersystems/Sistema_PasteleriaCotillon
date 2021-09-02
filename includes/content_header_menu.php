      <!--===========================HEADER-MENU===============================-->
      <!--===================NAV-BAR===================-->
      <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #424242;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="		Toggle navigation">Men&uacute;</button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="		Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul id="lista" class="navbar-nav">
            <?php
             
              $paginaActual = basename($_SERVER['PHP_SELF']);
              //Vector que contiene los Items del Menu
              $vectorMenu = array(
                'Inicio'=>'index.php',
                'Nosotros'=>'index_about.php',
                'Cat&aacute;logo'=>'index_promotion.php',
                'Galer&iacute;a'=>'index_gallery.php',
                'Contacto'=>'index_contact.php',
                'Administraci&oacute;n'=>'#MenuDesplegable');
              
              //Recorre el vectorMenu y arma la barra del menu
              foreach ($vectorMenu as $i_item => $menuHref){
                $itemActivo = ($paginaActual == $menuHref)? "active":"";
                $itemClase = ($paginaActual == $menuHref)? "CsItemNavBarSelected":"CsItemNavBar";

                if ($menuHref == "#MenuDesplegable"){
                  //Verifica que se ha iniciado una Sesion de Administrador para mostrar este Menu
                  if(isset($_SESSION['usuario'])){
                    //Vector que contiene los Items del Menu Desplegable (Codigo Escalable)
                    $vectorSubMenu = array(
                      'Art&iacute;culos'=>'index_admin_article.php',
                      'Eventos'=>'index_admin_event.php',
                      'Productos'=>'index_admin_production.php',
                      'Promociones'=>'index_admin_promotion.php',
                      'Usuarios'=>'index_admin_user.php');

                    //Crea un item de tipo Menu Desplegable
                    crearMenuDesplegable($paginaActual, $vectorSubMenu, $menuHref, $i_item);   

                    //Recorre el vectorSubMenu y arma un Menu desplegable
                    foreach ($vectorSubMenu as $j_item => $subMenuHref){
                      $sub_itemClase = ($paginaActual == $subMenuHref)? "CsItemNavBarSelected":"CsItemNavBar";  
                      //Dibuja Los Items del SubMenu
                      echo "<a class=\"dropdown-item ".$sub_itemClase."\" href=\"".$subMenuHref."\">".$j_item."</a>\r\n\t\t\t\t\t";
                    }
                    echo "</div></li>";
                  }
                }else{
                  //Dibuja Los Items del Menu
                  echo "<li class=\"nav-item ".$itemActivo."\"><a class=\"nav-link ".$itemClase."\" href=\"".$menuHref."\">".$i_item."</a></li>\r\n\t\t\t";
                }
              }

              //Funcion que crea un Menu Desplegable
              function crearMenuDesplegable($pagina, $vector, $var1, $var2){
                $menuDesplegableActivo = "";
                $menuDesplegableClase = "CsItemNavBar";  
                foreach ($vector as $i => $value) {
                  if ($pagina == $value) {
                    $menuDesplegableActivo = "active";
                    $menuDesplegableClase = "CsItemNavBarSelected";  
                  }
                }
                echo "<li class=\"nav-item dropdown ".$menuDesplegableActivo."\">
                <a class=\"nav-link dropdown-toggle ".$menuDesplegableClase."\" href=\"".$var1."\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">".$var2."</a>\t\t
                <div class=\"dropdown-menu CsMenuDesplegable\" aria-labelledby=\"navbarDropdown\">\r\n\t\t\t\t\t";
              }
            ?>
          </ul>
        </div>
      </nav>