<?php
include '../db/db.php';

if (isset($_GET['id'])){
    
    $id = $_GET['id'];
    $sql= "SELECT * FROM user WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result)==1){
    $row = mysqli_fetch_array($result);
     $nombre = $row['nombres'];
     $apellido = $row['apellidos'];
     $fechaNacimiento = $row['fecha_nacimiento'];
     $contraseña = $row['pass'];
    }
    
}
if (isset($_POST['update'])){
    $id = $_GET['id'];
    $nombre = $_POST['nombres'];
    $apellido = $_POST['apellidos'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $contraseña = $_POST['pass'];
 
    $sql= "UPDATE user SET nombres='$nombre', apellidos='$apellido', fecha_nacimiento= '$fechaNacimiento',pass='$contraseña'"
            . "             WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message']= 'Usuario Editado correctamente';
       $_SESSION['message_type'] = 'success';
        header("Location: ../views/user.php");
  } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  
  mysqli_close($conn);
  }
    }
?>


<?php include("../includes/header.php")?> 
<div class="container p-4">
    <div class="row">
        <div class="cold-md-4 mx-auto">
            <div class="card card-body">
                <form action="../controllers/editUser.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="nombres" value="<?php echo $nombre; ?>"
                               class="form-control" placeholder="Actualizar nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" name="apellidos" value="<?php echo $apellido; ?>"
                               class="form-control" placeholder="Actualizar apellido">
                    </div>
                    <div class="form-group">
                        <input type="date" name="fecha_nacimiento" value="<?php echo $fechaNacimiento; ?>"
                               class="form-control" placeholder="Actualizar fecha de nacimiento">
                    </div>
                    <div class="form-group">
                        <input type="text" name="pass" value=""
                               class="form-control" placeholder="Actualizar contraseña">
                    </div>
                    <button class="btn-success" name="update">
                        editar
                    </button>
                    
                </form>
            </div>
            
        </div>
    </div>
</div>

<?php include("../includes/footer.php") ?>