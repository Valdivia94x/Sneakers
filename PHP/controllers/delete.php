<?php
include '../db/db.php';

if (isset($_GET['id'])){
    
    $id = $_GET['id'];
    $sql= "DELETE FROM user WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
       $_SESSION['message']= 'Usuario eliminado';
       $_SESSION['message_type'] = 'danger';
       header("Location: ../views/Admin.php");
  } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  
  mysqli_close($conn);
  }
}

?>