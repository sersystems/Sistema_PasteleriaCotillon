<?php

  function crearPaginacion($tabla, $enlace, $elementos_xPagina){
    $consultaDB = consultarDB("SELECT * FROM ".$tabla);
    $totalElementos = mysqli_num_rows($consultaDB);
    mysqli_free_result($consultaDB);
    $totalPaginas = ceil($totalElementos / $elementos_xPagina);
    $paginaAnterior = (isset($_GET['pag']) && $_GET['pag']>1)? ($_GET['pag']-1) : 1;
    $paginaSiguiente = (isset($_GET['pag']) && $_GET['pag']>0 && $_GET['pag']<$totalPaginas)? ($_GET['pag']+1) : $totalPaginas;
    $paginaActual = (isset($_GET['pag']))? ($_GET['pag']) : "1";
    
    echo 
    '<div col-12>
      <p class="h6 float-md-right text-center text-white animated tada">P&aacute;gina '.$paginaActual.'</p>
    </div>
    <div class="col-12">
      <nav aria-label="...">
        <ul id="idPanelPaginacion" class="pagination pagination-sm justify-content-center ml-md-4 ml-lg-5">
          <li class="page-item">
            <a class="page-link" href="'.$enlace.'?pag='.$paginaAnterior.'">Anterior</a>
          </li>';
          for ($i=1; $i<$totalPaginas+1; $i++) { 
            echo '<li class="page-item"><a class="page-link" href="'.$enlace.'?pag='.$i.'">'.$i.'</a></li>';
          }

          echo 
          '<li class="page-item">
            <a class="page-link" href="'.$enlace.'?pag='.$paginaSiguiente.'">Siguiente</a>
          </li>
        </ul>
      </nav>
    </div>';
  }
   
  function paginarConsulta($elementos_xPagina){
    if (isset($_GET['pag'])) {
      $desde = ($_GET['pag']<=1)? 0 : (($_GET['pag']-1)*$elementos_xPagina);
      $hasta = ($_GET['pag']*$elementos_xPagina);
    }else{
      $desde = 0;
      $hasta = $elementos_xPagina;
    }
    return ($desde.", ".$hasta);
  }
?>