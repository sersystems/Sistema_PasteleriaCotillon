<?php
  
  function formatearFecha($fecha){
  	$servidor = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($servidor, 'Trident') !== FALSE) {
      //Navegador: Internet Explorer
      return date("d/m/Y", strtotime($fecha));
    
    }elseif (strpos($servidor, 'Firefox') !== FALSE) {
      //Navegador: Mozilla FireFox
      return date("Y-m-d", strtotime($fecha));    
    
    }elseif (strpos($servidor, 'Chrome') !== FALSE) {
      //Navegador: Google Chrome
      return date("Y-m-d", strtotime($fecha));
   
    }else{
      //Navegador: Otros navegadores
      return date("d/m/Y", strtotime($fecha));
    }
  }
?>