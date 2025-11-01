<?php

     define('DB_SERVER', 'localhost');
     define('DB_USERNAME','root');
     define('DB_PASSWORD', 'root');
     define('DB_NAME', 'sistema_ventas');

     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
     if($link === false){
        die("Error en la conexión" .mysqli_connect_error());
     }else{
        
     }

?>