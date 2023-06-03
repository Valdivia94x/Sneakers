<?php
    include 'global/db.php';
    include 'carrito.php';
    include 'templates/header.php';
?>
        <br>
        <?php if($mensaje != ""){ ?>
        <div class="alert alert-success">
            <?php echo $mensaje; ?>
            <a href="miCarrito.php" class="btn btn-success">Ver carrito</a>
        </div>
        <?php } ?>    
        <div class="row">
        <?php
            $db = new DB();
            $query = $db->connect()->prepare('SELECT * FROM productos');
            $query->execute();
            $listaProductos = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach($listaProductos as $producto){ ?>
            <div class="col-12 col-md-3">
                <div class="card my-2 shadow p-3 mb-5 bg-white rounded">
                    <img 
                    title="<?php echo $producto['descripcion']; ?>" 
                    class="card-img-top"  
                    src="archivos/img/<?php echo $producto['imagen']; ?>" 
                    alt="<?php echo $producto['nombre']; ?>"
                    data-toggle="popover"
                    data-trigger="hover"
                    data-content= "<?php echo $producto['descripcion']; ?>"
                    >
                    <div class="card-body" style="float: bottom;">
                        <span><?php echo $producto['nombre']; ?></span>
                        <h5 class="card-title">$<?php echo $producto['precio']; ?></h5>

                        <form action="" method="post">

                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

                        <button class="btn btn-warning text-white fs-bold my-2" type="submit" 
                        name="btnAccion" value="Agregar">Agregar al carrito
                        </button>

                        </form>
                        
                    </div>
                </div>
            </div>

        <?php } ?>
            

        </div>

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    

<script>

    $(function () {
        $('[data-toggle="popover"]').popover()
    });
</script>
<?php include 'templates/footer.php' ?>