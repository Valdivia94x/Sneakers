<?php
$alert ='';
if (!empty($_POST)){
    if (empty($_POST['user']) || empty($_POST['pass'])){
        $alert = "estan vacios";
    } else {
        require_once '../db/db.php';
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $sql = mysqli_query($conn,"SELECT * FROM user WHERE user= '$user' AND pass='$pass'");
        $result = mysqli_num_rows($sql);
        if ($result>0 ){
            $data = mysqli_fetch_array($sql);
            print_r($data);
            session_start();
            $_SESSION['active']= true;
            $_SESSION['id'] = $data['id'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['user'] = $data['user'];
            $_SESSION['rol'] = $data['rol'];
               if ($data['rol']==1){
                header('location: Admin.php' );
            } else {
                 header('location: User.php' );
            }
          
            
            
        }else{
            $alert= 'El usuario o la contraseña son incorrectos';
            session_destroy();
            
        }
    }
}

?>
  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <h1>Iniciar sesion</h1>
    <form action="" method="POST">
      <input name="user" type="text" placeholder="Digita tu usuario">
      <input name="pass" type="password" placeholder="Digita tu contraseña">
      <div class="alert"><?php echo isset($alert)? $alert : ''; ?> </div>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
