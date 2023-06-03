<?php 
include("../db/db.php");

if(isset($_POST['Guardar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipo = $_POST['tipo'];
    $numero = $_POST['numero'];
    $usuario = $_POST['usuario'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['1'];

    $sql = "INSERT INTO `user`(`tipo_identificacion`, `user`, `nombres`, `apellidos`, `identificacion`, `fecha_nacimiento`, `rol`,`pass`)"
            . "          VALUES ('$tipo',' $usuario',' $nombre','$apellido', '$numero','$fechaNacimiento',' $rol','$contraseña')";
    
    if (mysqli_query($conn, $sql)) {
       $_SESSION['message']= 'Usuario registrado';
       $_SESSION['message_type'] = 'success';
       header("Location: ../views/admin.php");
  } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  
  mysqli_close($conn);
  }
   
}
?>