<?php
    include 'global/db.php';
    include 'carrito.php';
    include 'templates/header.php';
?>

<?php
    if($_POST){
        $total = 0;
        $SID = session_id();
        $correo = $_POST['email'];
        $nombre = $_POST['nombre-completo'];
        $direccion = $_POST['direccion'];

        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $total = $total + ($producto['precio'] * $producto['cantidad']);
        }
        $db = new DB();
        $pdo = $db->connect();
        
        $query = $pdo->prepare("INSERT INTO `tblventas` (`id`, `clave_transaccion`, `paypal_datos`, `fecha`, `correo`, `total`, `status`) 
        VALUES (NULL, :claveTransaccion, '', NOW(), :correo, :total, 'pendiente')");

        
        $query->bindParam(":claveTransaccion", $SID);
        $query->bindParam(":total", $total);
        $query->bindParam(":correo", $correo);
        $query->execute();

        $id_venta = $pdo->lastInsertId();
        
        


        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $query = $pdo->prepare("INSERT INTO `tbldetalleventa` (`id`, `id_venta`, `id_producto`, `precio_unitario`, `cantidad`, `descargado`) 
            VALUES (NULL, :id_venta, :id_producto, :precio_unitario, :cantidad, '0');");
            
            $query->bindParam(":id_venta", $id_venta);
            $query->bindParam(":id_producto", $producto['id']);
            $query->bindParam(":precio_unitario", $producto['precio']);
            $query->bindParam(":cantidad", $producto['cantidad']);
            $query->execute();
        }
    }
?>

<style>
        /* Media query for mobile viewport */
        @media screen and (max-width: 400px) {
            #paypal-button-container {
                width: 100%;
                margin-left: auto;
                margin-right: auto;
            }
        }
        
        /* Media query for desktop viewport */
        @media screen and (min-width: 400px) {
            #paypal-button-container {
                width: 250px;
                margin-left: auto;
                margin-right: auto;
            }
        }
</style>


<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final !</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar con paypal la cantidad de: <br>
        <h4>$<?php echo number_format($total, 2); ?></h4>
        <div id="paypal-button-container"></div>
    </p>
    
    <p>Los productos serán enviados una vez que sea procesado el pago.<br>
        <strong>(Para aclaraciones: abc@hotmail.com)</strong>
    </p>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=ARgYeJVD71qQo0xJDa1iptMetk3AZf0nrh7URRb2jZHZv6NTubkgiZzRJ6Wke6sAoyhH5dEBs1ATY-lE&currency=USD"></script>

<script>
      paypal.Buttons({
        style: {
            label: 'checkout',
            size: 'responsive',
            color: 'gold',
            shape: 'pill',
        },
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '77.44' // Can also reference a variable or function
              },
              description: "Compra de productos a ",
              custom: "<?php echo $SID; ?>#<?php echo openssl_encrypt($id_venta, COD, KEY) ?>"
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            window.location = "verificar.php?transactionId=" + transaction.id;
          });
        }
      }).render('#paypal-button-container');
            
    </script>
<?php include 'templates/footer.php' ?>