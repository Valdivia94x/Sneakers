<?php
    session_start();
    $mensaje = "";

    if(isset($_POST['btnAccion'])){
        switch($_POST['btnAccion']){

            case 'Agregar':
                if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
                    $id = openssl_decrypt($_POST['id'], COD, KEY);
                    

                }else{
                    $mensaje .= "ERROR id incorrecto";
                }

                if(is_string(openssl_decrypt($_POST['nombre'], COD, KEY))){
                    $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                    
                }else{
                    $mensaje = "Nombre incorrecto";
                    break;
                }

                if(is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))){
                    $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
                    
                }else{
                    $mensaje = "Cantidad incorrecta";
                    break;
                }

                if(is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))){
                    $precio = openssl_decrypt($_POST['precio'], COD, KEY);
                    
                }else{
                    $mensaje = "Precio incorrecto";
                    break;
                }

                function agregarAlCarrito(){
                    $id = openssl_decrypt($_POST['id'], COD, KEY);
                    $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                    $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
                    $precio = openssl_decrypt($_POST['precio'], COD, KEY);

                    if(isset($_SESSION['CARRITO'])){
                        $items_id_cart = array_column($_SESSION['CARRITO'], 'id');
                        if(!in_array($id, $items_id_cart)){
                            $numeroElementos = count($_SESSION['CARRITO']);
                            $item = array(
                                'id' => $id,
                                'nombre' => $nombre,
                                'cantidad' => $cantidad,
                                'precio' => $precio
                            );

                            $_SESSION['CARRITO'][$numeroElementos] = $item;
                            $mensaje = "Producto agregado al carrito.";
                            
                        }else{
                           
                            $items = $_SESSION['CARRITO'];

                            for($i=0; $i<sizeof($items); $i++){
                                if($items[$i]['id'] == $id){
                                    $items[$i]['cantidad']++;
                                    $_SESSION['CARRITO'] = $items;
                
                                    
                                }
                            }
                            $mensaje = "Producto agregado al carrito.";
                        }
                    }else{
                        $item = array(
                            'id' => $id,
                            'nombre' => $nombre,
                            'cantidad' => $cantidad,
                            'precio' => $precio
                        );

                        $_SESSION['CARRITO'][0] = $item;
                        $mensaje = "Producto agregado al carrito.";
                        
                    }
                    
                    return $mensaje;
                }

                $mensaje = agregarAlCarrito();


            break;

            case 'Eliminar':

                function borrarDelCarrito(){
                    $id = openssl_decrypt($_POST['id'], COD, KEY);
                    if($_SESSION['CARRITO'] == NULL){
                        $items = [];
                    }else{
                        $items = $_SESSION['CARRITO'];
            
                        for($i =0; $i< sizeof($items); $i++){
            
                            if($items[$i]['id'] == $id){
                                $items[$i]['cantidad']--;
            
                                if($items[$i]['cantidad'] == 0){
                                    unset($items[$i]);
                                    $items = array_values($items);
                                }
            
                                $_SESSION['CARRITO'] = $items;
                            }
                        }
                    }
                }

                borrarDelCarrito();
                  
            break;
        }
    }
?>