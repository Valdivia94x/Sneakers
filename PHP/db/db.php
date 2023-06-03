<?php

session_start();

   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'crud');
   $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if($conn -> connect_errno){
      die("Conexion Fallida". $conexion->connect_errno);
   }else{
      echo "conectado";
   }
?>
