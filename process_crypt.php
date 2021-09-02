<?php

    function encriptar($texto){
        $algoritmo = MCRYPT_BLOWFISH;
        $llave64 = '55abe029ebae5e1d417e2fb20a3UoSokvs9ucaYxssbVV8TT2qsRokrX';
        $modo = MCRYPT_MODE_CBC;
        $encriptacion = mcrypt_encrypt($algoritmo, $llave64, trim($texto), $modo, 'Ro2k9rX1');
        return base64_encode($encriptacion);
    }

    function desencriptar($codigoHash){
        $algoritmo = MCRYPT_BLOWFISH;
        $llave64 = '55abe029ebae5e1d417e2fb20a3UoSokvs9ucaYxssbVV8TT2qsRokrX';
        $modo = MCRYPT_MODE_CBC;
        $desencriptacion = mcrypt_decrypt($algoritmo, $llave64, base64_decode($codigoHash), $modo, 'Ro2k9rX1');
        return $desencriptacion;
    }
?>
