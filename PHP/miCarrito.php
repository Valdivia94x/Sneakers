<?php
    include 'global/db.php';
    include 'carrito.php';
    include 'templates/header.php';
?>

<br>
<h3>Lista del carrito</h3>
<?php if(!empty($_SESSION['CARRITO'])){


?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%">Descripcion</th>
            <th width="15%" class="text-center">Cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%">---</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){?>
        <tr>
            <td width="40%"><?php echo $producto['nombre']; ?></td>
            <td width="15%" class="text-center"><?php echo $producto['cantidad']; ?></td>
            <td width="20%" class="text-center">$<?php echo $producto['precio']; ?></td>
            <td width="20%" class="text-center">$<?php echo number_format($producto['precio'] * $producto['cantidad'], 2);  ?></td>
            <td width="5%">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                <button class="btn btn-danger btn-sm" name="btnAccion" value="Eliminar" type="submit">Eliminar</button>
            </form>
            </td>
        </tr>
        <?php $total = $total + ($producto['precio']*$producto['cantidad']);?>
        <?php } ?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3>$<?php echo number_format($total, 2); ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <form action="pago.php" method="post">
                    <div class="alert alert-info" role="alert">
                        <div class="form-group my-2">
                            <label for="my-input">Correo de contacto:</label>
                            <input id="email" name="email" 
                            type="email" 
                            class="form-control my-2" 
                            type="text"
                            placeholder="Por favor escribe tu email"
                            required>
                        </div> 
                        <div class="form-group my-2">
                            <label for="">Nombre completo: </label>
                            <input type="text" class="form-control my-2" name="nombre-completo" placeholder="Nombre completo..." required>
                        </div>
                        <div class="form-group my-2">
                            <label for="">Direccion: </label>
                            <input type="text" class="form-control my-2" name="direccion" placeholder="Direccion..." required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">
                            Los productos se enviarán a la dirección suministrada anteriormente.
                        </small>
                    </div>

                    <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg" type="submit" value="proceder" name="btnAccion">Proceder a pagar >></button>
                    </div>

                </form>
            </td>
        </tr>
        
    </tbody>
</table>
<?php }else{?>
   <div class="alert alert-success" role="alert">
       No hay productos en el carrito...
   </div>

<?php } ?>
    

<?php include 'templates/footer.php' ?>