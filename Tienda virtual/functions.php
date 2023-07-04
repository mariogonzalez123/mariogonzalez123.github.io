<?php


//VALIDACIONES REGISTRO.


//VALIDA SI UN NOMBRE ES VALIDO.
 function nombreValido($nombre){
  if (preg_match("/[A-Z]/", $nombre) && preg_match("/[a-z]/", $nombre) && strlen($nombre) > 3 && strlen($nombre) < 15) {
    $nombre_valido = true;
} else {
    $nombre_valido = false;
 }
 return $nombre_valido;
 }

 function ciudadValida($ciudad){
   if(preg_match("/[A-Z]/", $ciudad)){
       return true;
   }
   return false;
 }
 
 
 //VALIDA SI UN CÓDIGO POSTAL ES VALIDO.
 function cpValido($cp){
     if(preg_match("/[0-9]{5}/", $cp)){
         return true;
     }
     return false;
 }
 //VALIDA SI UNA FECHA DE CADUCIDAD DE UNA TARJETA DE CREDITO ES VALIDO.
 function caducidadValida($caducidad){
     
     if(preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/", $caducidad)){
         return true;
     }
     return false;
 }
 //VALIDA SI UN CVV ES VALIDO
 function cvvValido($cvv){
     if(preg_match("/[0-9]{3}/", $cvv)){
         return true;
     }
     return false;
     
 }
 
 //VALIDA SI UNA CONTRASEÑA ES VALIDA
 function passwordValida($contraseña){
    if (preg_match("/^[A-Z][A-Za-z0-9]{4,}/", $contraseña)) {
        $contraseña_valida = true;
    }
    else{
        $contraseña_valida = false;
    }
     return $contraseña_valida;
 }

//VALIDA SI UNA TARJETA DE CREDITO ES VALIDA
 function tarjetaValida($tarjeta){
     
     if(preg_match("/^3[47][0-9]{13}$/", $tarjeta)){
         return true;
     }
     if(preg_match("/^6(?:011|5[0-9]{2})[0-9]{12}$/", $tarjeta)){
         return true;
     }
     if(preg_match("/5[1-5][0-9]{14}$/", $tarjeta)){
         return true;
     }
      if(preg_match("/^4[0-9]{12}(?:[0-9]{3})?$/", $tarjeta)){
         return true;
     }
     
     return false;
 }


?>
