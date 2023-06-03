<?php include("../db/db.php") ?>
<?php include("../includes/header.php") ?>

    <div class="container p-4">
        <div class="row">
    
            <div class="cold-md-4">
                
                <?php if(isset($_SESSION['message'])){ ?>
                    <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                <?php session_unset();}?>
                
            <div class="card card-body">
            <form action="../controllers/insertUser.php" method="POST">
            <div class="form-group">
               <input type="text" name="nombre" class="form-control" placeholder="ingrese sus nombres" autofocus>
               
            </div>
            <div class="form-group">
            <input type="text" name="apellido" class="form-control" placeholder="Ingrese sus apellidos" autofocus>
               
            </div>
            <div class="form-group">
            <select class="form-control" name="tipo">
                <option disabled selected>Tipo de identificacion</option>
                <option>Cedula</option>
                <option>Tarjeta de identidad</option>
                <option>Cedula extranjera</option>
            </select>
            </div>
            <div class="form-group">
            <input type="number" name="numero" class="form-control" placeholder="Numero identificacion" autofocus>
               
            </div>
            <div class="form-group">
            <input type="text" name="usuario" class="form-control" placeholder="Ingrese su usuario" autofocus>
               
            </div>
            <div class="form-group">
            <input type="date" name="fechaNacimiento" class="form-control" placeholder="Ingrese fecha nacimiento" autofocus>
               
            </div>
            <div class="form-group">
            <input type="password" name="contraseña" class="form-control" placeholder="Ingrese su contraseña" autofocus>
               
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="1" value="0">Usuario
                </label>
            </div>
            <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="1" value="1">Administrador
            </label>
            </div>
            <input type="submit" class="btn btn-success btn-block" name="Guardar" value="Guardar">
            </form>
            
            </div>
    
            </div> 

            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nro Identificacion</th>
                            <th>Nombres</th>
                            <th>Usuario</th>
                            <th>Fecha Nacimiento</th>
                            <th>Rol</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql="SELECT * FROM user where rol=0";
                        $result = mysqli_query($conn, $sql);
                        
                        
                        while($row = mysqli_fetch_array($result)){ ?>
                        <tr>
                            <td><?php echo $row[('identificacion')]  ?></td>
                            <td><?php echo $row[('nombres')] ?></td>
                            <td><?php echo $row[('user')] ?> </td>
                            <td><?php echo $row[('fecha_nacimiento')]?></td>
                            <td><?php 
         if ($row[('rol')]=='1') {
             echo 'administrador';
         } else {
             echo 'usuario';    
         }
                            ?>
                            <td>
                                <a href="../controllers/editUser.php?id=<?php echo $row['id'] ?>" 
                                    class="btn btn-secondary">
                                <i class="fas fa-marker"></i> 
                                </a>
                                
                                <a href="../controllers/deleteUser.php?id=<?php echo $row['id'] ?>" 
                                   class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>   
                                </a>
                            </td>
                            
                            
                        </tr>
                        
                        <?php }?>
                    </tbody>
                </table>
            </div>   
	</div>
</div>
        </div>
    
    </div>



  <?php include("../includes/footer.php") ?>