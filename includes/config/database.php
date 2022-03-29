<?php 

function conectarDB() : mysqli {
    //creamos una variable...
    $db = mysqli_connect('localhost', 'root', 'brunoponce97', 'bienes_raices');
    /* la otra opcion seria usar PDO, pero requiere conocimientos
     en programacion orientada a objetos */

    /*  if($db){
         echo "se conecto";
     }else{
         echo "no se conecto";
     } */

     if(!$db){
       echo "Error, no se pudo conectar a la base de datos";
       exit; /* se encarga de que las demas lineas no se ejecuten ya que
       de lo contrario puede revelar informacion sensible*/
     }

     return $db;

}